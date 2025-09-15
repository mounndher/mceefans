<?php

namespace App\Http\Controllers\Admin;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fan;
use App\Models\TransactionPaimnt;
use App\Models\Abonment;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FanController extends Controller
{


    // Display all fans
    public function index()
    {
        $fans = Fan::where('status','active')->get();
        $abonments = Abonment::where('status','active')->get(); // قائمة كل Abonments
        //dd($abonments); // اختبر لو تحب
        return view('backend.fans.index', compact('fans','abonments'));
    }
    public function expired()
    {
        $fans = Fan::where('status','expired')->get();
        $abonments = Abonment::where('status','active')->get(); // قائمة كل Abonments
        //dd($abonments); // اختبر لو تحب
        return view('backend.fans.expired', compact('fans','abonments'));
    }
    public function create()
    {
        $abonments = Abonment::all();
        return view('backend.fans.create', compact('abonments'));
    }

    // Store a new fan
    public function renouvelerAbonment(Request $request, $fanId)
{
    // 1. نجيب الـFan
    $fan = Fan::findOrFail($fanId);

    // 2. نتحقق من الإدخال (abonment جديد)
    $validated = $request->validate([
        'id_abonment' => 'required|exists:abonments,id',
    ]);

    // 3. نجيب الـAbonment
    $abonment = Abonment::findOrFail($validated['id_abonment']);
    $dd=$abonment;
    //dd($dd);
    // 4. نضيف TransactionPaimnt جديد (ما نغير id_qrcode)
    TransactionPaimnt::create([
    'id_fan'      => $fan->id,
    'id_abonment' => $abonment->id,
    'date'        => now(),
    'prix'        => $abonment->prix,  // force numeric
    'nbrmatch'    => $abonment->nbrmatch,
]);

    // 5. إذا حاب تحدث تاريخ صلاحية البطاقة
    // مثلا تمدد 5 سنوات إضافية من اليوم
    // $fan->valid_until = now()->addYears(5);
    // $fan->save();

    return redirect()->route('fans.index')
        ->with('success', 'Abonnement renouvelé avec succès sans changer le QR code.');
}




    public function store(Request $request)
    {
        // ✅ Validate input
        $validated = $request->validate([
            'nom'          => 'required|string|max:255',
            'prenom'       => 'required|string|max:255',
            'nin'          => 'required|string|size:18|unique:fan,nin',
            'numero_tele'  => 'required|string|max:20',
            'date_de_nai'  => 'required|date',
            'image'        => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'imagecart'        => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'id_abonment'  => 'required|exists:abonments,id',
        ]);

        $uploadsFolder = public_path('uploads');
        if (!file_exists($uploadsFolder)) {
            mkdir($uploadsFolder, 0777, true);
        }

        // ✅ Generate random ID for QR code data
        $randomId = $validated['nom'] . '-' . Str::random(6);
        $validated['id_qrcode'] = $randomId;

        // ✅ Generate QR code (150px size)
        $qrFileName = $randomId . '_qr.png';
        $qrPath = $uploadsFolder . '/' . $qrFileName;
        $pngData = QrCode::format('png')->size(100)->generate($randomId);
        file_put_contents($qrPath, $pngData);
        $validated['qr_img'] = '/uploads/' . $qrFileName;

        // ✅ Upload profile image
        $profileFile = $request->file('image');
        $profileFileName = uniqid() . '_' . $profileFile->getClientOriginalName();
        $profileFile->move($uploadsFolder, $profileFileName);
        $validated['image'] = '/uploads/' . $profileFileName;

        $profileFile = $request->file('imagecart');
        $profileFileName = uniqid() . '_' . $profileFile->getClientOriginalName();
        $profileFile->move($uploadsFolder, $profileFileName);
        $validated['imagecart'] = '/uploads/' . $profileFileName;

        // ✅ Load card template
        // ✅ Fetch abonment (with template path)
        $abonment = Abonment::findOrFail($request->id_abonment);

        // ✅ Load card template from abonment->desgin_card
        $cardTemplatePath = public_path($abonment->desgin_card);

        // dd($cardTemplatePath);
        // dd($abonment->desgin_card);
        if (!file_exists($cardTemplatePath)) {
            return back()->withErrors(['desgin_card' => 'Card template not found at ' . $cardTemplatePath]);
        }

        $card = imagecreatefrompng($cardTemplatePath);
        $cardWidth = imagesx($card);
        $cardHeight = imagesy($card);

        // ✅ Insert QR code on card (top right corner)
        $qr = imagecreatefrompng($qrPath);
        $qrWidth = imagesx($qr);
        $qrHeight = imagesy($qr);
        $qrX = $cardWidth - $qrWidth - 30;  // Top right position
        $qrY = 30;  // Top margin
        imagecopy($card, $qr, $qrX, $qrY, 0, 0, $qrWidth, $qrHeight);
        imagedestroy($qr);

        // ✅ Insert profile image (scaled to 150x200, left side)
        $profileImagePath = public_path($validated['image']);
        $profileExt = strtolower(pathinfo($profileImagePath, PATHINFO_EXTENSION));
        switch ($profileExt) {
            case 'png':
                $profile = imagecreatefrompng($profileImagePath);
                break;
            case 'jpg':
            case 'jpeg':
            default:
                $profile = imagecreatefromjpeg($profileImagePath);
                break;
        }
        $profile = imagescale($profile, 150, 200);  // Larger profile image
        $profileX = 30;   // Left margin
        $profileY = 150;  // Position below header
        imagecopy($card, $profile, $profileX, $profileY, 0, 0, 150, 200);
        imagedestroy($profile);

        // ✅ Text color & font
        $black = imagecolorallocate($card, 0, 0, 0);
        $fontPath = public_path('fonts/arial.ttf');

        // ✅ Add texts with new positions matching the image layout

        // Starting X position for text (right of profile image)
        $textStartX = 200;

        // Nom (Name) - positioned to the right of profile image
        $nameText = strtoupper($validated['nom']);
        imagettftext($card, 20, 0, $textStartX, 200, $black, $fontPath, $nameText);

        // Prénom (First Name) - below name
        $prenomText = strtoupper($validated['prenom']);
        imagettftext($card, 20, 0, $textStartX, 240, $black, $fontPath, $prenomText);

        // N d'immatriculation (Registration Number) - you might need to add this field to validation
        //$immatriculationText = '100003200095624670'; // This should come from your form data
        //imagettftext($card, 18, 0, $textStartX, 280, $black, $fontPath, $immatriculationText);

        // NIN (National ID) - below immatriculation
        $ninText = $validated['nin'];
        imagettftext($card, 18, 0, $textStartX, 320, $black, $fontPath, $ninText);

        // Activity - below NIN
        //$activityText = 'DÉVELOPPEUR(SE) MOBILE';
        //imagettftext($card, 18, 0, $textStartX, 360, $black, $fontPath, $activityText);

        // Date d'émission (Issue Date) - left side, below activity
        $dateIssue = date('d.m.Y');
        imagettftext($card, 16, 0, $textStartX, 420, $black, $fontPath, $dateIssue);

        // Date de validité (Valid Until) - right side
        $dateValid = date('d.m.Y', strtotime('+5 years'));
        imagettftext($card, 16, 0, $cardWidth - 200, 420, $black, $fontPath, $dateValid);

        // Phone number at bottom
        $telText = $validated['numero_tele'];
        imagettftext($card, 16, 0, 50, $cardHeight - 60, $black, $fontPath, $telText);

        // Add labels in Arabic (if needed) - positioned to the right
        $labelX = $cardWidth - 150;

        // Arabic labels (you can adjust these based on your needs)
        //imagettftext($card, 16, 0, $labelX, 200, $black, $fontPath, 'اللقب');      // Surname
        // imagettftext($card, 16, 0, $labelX, 240, $black, $fontPath, 'الاسم');      // First name
        //imagettftext($card, 16, 0, $labelX, 280, $black, $fontPath, 'رقم التسجيل'); // Registration number
        // imagettftext($card, 16, 0, $labelX, 320, $black, $fontPath, 'رقم التعريف الوطني'); // NIN
        //imagettftext($card, 16, 0, $labelX, 360, $black, $fontPath, 'النشاط');     // Activity

        // ✅ Save final card image
        $cardFileName = $randomId . '_card.png';
        $cardPath = $uploadsFolder . '/' . $cardFileName;
        imagepng($card, $cardPath);
        imagedestroy($card);

        $validated['card'] = '/uploads/' . $cardFileName;

        // ✅ Save fan data to DB
        $fan = Fan::create($validated);

        // ✅ Create associated transaction
        $abonment = Abonment::findOrFail($request->id_abonment);
        TransactionPaimnt::create([
            'id_fan'      => $fan->id,
            'id_abonment' => $abonment->id,
            'date'        => now(),
            'prix'        => $abonment->prix,
            'nbrmatch'    => $abonment->nbrmatch,
        ]);

        return redirect()->route('fans.index')
            ->with('success', 'Fan created successfully with virtual card and transaction.');
    }





    public function show($id)
    {
        $fan = Fan::findOrFail($id);
        return view('backend.fans.show', compact('fan'));
    }

    // Show a single fan
    public function edit($id)
    {
        $fan = Fan::findOrFail($id);
        return view('backend.fans.edit', compact('fan'));
    }




    // Update fan
    public function update(Request $request, $id)
    {
        $fan = Fan::findOrFail($id);

        // Validate input
        $validated = $request->validate([
            'nom'          => 'required|string|max:255',
            'prenom'       => 'required|string|max:255',
            'nin'          => 'required|string|size:18|unique:fan,nin,' . $fan->id,
            'numero_tele'  => 'required|string|max:20',
            'date_de_nai'  => 'required|date',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'imagecart'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'card'         => 'nullable|string',
            'id_qrcode'    => 'nullable|string',
            'qr_img'       => 'nullable|string',
        ]);

        $uploadsFolder = public_path('uploads');
        if (!file_exists($uploadsFolder)) {
            mkdir($uploadsFolder, 0777, true);
        }

        // Handle profile image upload if exists
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move($uploadsFolder, $fileName);
            $validated['image'] = '/uploads/' . $fileName;
        }
        if ($request->hasFile('imagecart')) {
            $file = $request->file('imagecart');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move($uploadsFolder, $fileName);
            $validated['imagecart'] = '/uploads/' . $fileName;
        }

        // Update fan
        $fan->update($validated);

        return redirect()->route('fans.index')->with('success', 'Fan updated successfully');
    }

    // Delete fan
    public function destroy($id)
{
    $fan = Fan::findOrFail($id);

    // update status instead of deleting
    $fan->status = 'expired';
    $fan->save();

    return redirect()->route('fans.index')->with('success', 'Fan marked as expired successfully');
}

}
