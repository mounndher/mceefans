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
use Barryvdh\DomPDF\Facade\Pdf;
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
        
        $abonments = Abonment::where('status','active')->get();
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
        'imagecart'    => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'id_abonment'  => 'required|exists:abonments,id',
    ]);

    $uploadsFolder = public_path('uploads');
    if (!file_exists($uploadsFolder)) {
        mkdir($uploadsFolder, 0777, true);
    }

    // ✅ Generate random ID for QR code data
    $randomId = $validated['nom'] . '-' . Str::random(6);
    $validated['id_qrcode'] = $randomId;

    // ✅ Generate QR code
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

    // ✅ Upload imagecart
    $cartFile = $request->file('imagecart');
    $cartFileName = uniqid() . '_' . $cartFile->getClientOriginalName();
    $cartFile->move($uploadsFolder, $cartFileName);
    $validated['imagecart'] = '/uploads/' . $cartFileName;

    // ✅ Fetch abonment (with template path)
    $abonment = Abonment::findOrFail($request->id_abonment);

    $cardTemplatePath = public_path($abonment->desgin_card);
    if (!file_exists($cardTemplatePath)) {
        return back()->withErrors(['desgin_card' => 'Card template not found at ' . $cardTemplatePath]);
    }

    // ✅ Detect file type and create template image
    $ext = strtolower(pathinfo($cardTemplatePath, PATHINFO_EXTENSION));
    switch ($ext) {
        case 'jpg':
        case 'jpeg':
            $card = imagecreatefromjpeg($cardTemplatePath);
            break;
        case 'png':
            $card = imagecreatefrompng($cardTemplatePath);
            break;
        default:
            return back()->withErrors(['desgin_card' => 'Unsupported template format. Only JPG/PNG allowed.']);
    }

    $cardWidth = imagesx($card);
    $cardHeight = imagesy($card);

    // ✅ Insert QR code (top right corner)
    $qr = imagecreatefrompng($qrPath);
    $qrWidth = imagesx($qr);
    $qrHeight = imagesy($qr);
    $qrX = $cardWidth - $qrWidth - 30;
    $qrY = 30;
    imagecopy($card, $qr, $qrX, $qrY, 0, 0, $qrWidth, $qrHeight);
    imagedestroy($qr);

    // ✅ Insert profile image (scaled)
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
    $profile = imagescale($profile, 150, 200);
    $profileX = 30;
    $profileY = 150;
    imagecopy($card, $profile, $profileX, $profileY, 0, 0, 150, 200);
    imagedestroy($profile);

    // ✅ Text color & font
    $black = imagecolorallocate($card, 0, 0, 0);
    $fontPath = public_path('fonts/arial.ttf');

    $textStartX = 200;

    // Name
    imagettftext($card, 20, 0, $textStartX, 200, $black, $fontPath, strtoupper($validated['nom']));
    // First Name
    imagettftext($card, 20, 0, $textStartX, 240, $black, $fontPath, strtoupper($validated['prenom']));
    // NIN


    // ✅ Save final card
    $cardFileName = $randomId . '_card.png';
    $cardPath = $uploadsFolder . '/' . $cardFileName;
    imagepng($card, $cardPath);
    imagedestroy($card);

    $validated['card'] = '/uploads/' . $cardFileName;

    // ✅ Save fan
    $fan = Fan::create($validated);
    $pdfQrFileName = $randomId . '_pdf_qr.png';
    $pdfQrPath = $uploadsFolder . '/' . $pdfQrFileName;

    $pdfUrl = route('fans.cardPdftelecharger', $fan->id); // link to PDF
    $pngData2 = QrCode::format('png')->size(100)->generate($pdfUrl);
    file_put_contents($pdfQrPath, $pngData2);

    $fan->update([
        'qr_pdf_img' => '/uploads/' . $pdfQrFileName,
    ]);

    // ✅ Save transaction
    TransactionPaimnt::create([
        'id_fan'      => $fan->id,
        'id_abonment' => $abonment->id,
        'date'        => now(),
        'prix'        => $abonment->prix,
        'nbrmatch'    => $abonment->nbrmatch,
    ]);

    return redirect()->route('fans.index')
        ->with('success', 'FAns créé avec succès avec carte virtuelle et transaction.');
}


public function cardPdftelecharger($id)
{
    $fan = Fan::findOrFail($id);

    $cardPath = public_path($fan->card);
    if (!file_exists($cardPath)) {
        abort(404, "Card not found.");
    }

    $pdf = Pdf::loadView('backend.fans.card_pdf', compact('fan'))
        ->setPaper([0, 0, 240, 156], 'portrait'); // حجم 8.5cm × 5.5cm

    return $pdf->download("card_{$fan->id}.pdf"); 
    // أو stream() لو حابب يفتح مباشرة
}


    public function regenerate($id)
{
    
    $fan = Fan::findOrFail($id);
    // dd($fan);
    $uploadsFolder = public_path('uploads');
    if (!file_exists($uploadsFolder)) {
        mkdir($uploadsFolder, 0777, true);
    }

    // ✅ Generate new random ID for card
    $randomId = $fan->nom . '-' . Str::random(6);
    $fan->id_qrcode = $randomId;
    $fan->id_card   = strtoupper(Str::random(10)); // if you keep an id_card

    // ✅ Generate new QR code
    $qrFileName = $randomId . '_qr.png';
    $qrPath = $uploadsFolder . '/' . $qrFileName;
    $pngData = QrCode::format('png')->size(100)->generate($randomId);
    file_put_contents($qrPath, $pngData);
    $fan->qr_img = '/uploads/' . $qrFileName;

    // ✅ Rebuild new card from abonment template
    $abonment = Abonment::findOrFail($fan->id_abonment);
    $cardTemplatePath = public_path($abonment->desgin_card);

    if (!file_exists($cardTemplatePath)) {
        return back()->withErrors(['desgin_card' => 'Card template not found']);
    }

    $card = imagecreatefrompng($cardTemplatePath);
    $cardWidth = imagesx($card);
    $cardHeight = imagesy($card);

    // Insert new QR code
    $qr = imagecreatefrompng($qrPath);
    $qrWidth = imagesx($qr);
    $qrHeight = imagesy($qr);
    $qrX = $cardWidth - $qrWidth - 30;
    $qrY = 30;
    imagecopy($card, $qr, $qrX, $qrY, 0, 0, $qrWidth, $qrHeight);
    imagedestroy($qr);

    // ✅ Save new card file
    $cardFileName = $randomId . '_card.png';
    $cardPath = $uploadsFolder . '/' . $cardFileName;
    imagepng($card, $cardPath);
    imagedestroy($card);

    $fan->card = '/uploads/' . $cardFileName;

    // ✅ Save updates only for QR, card, id_card
    $fan->save();

    return redirect()->route('fans.index')
        ->with('success', 'Le code QR, la carte et la carte d identité ont été régénérés avec succès.');
}


public function cardPdf($id)

{
    $fan = Fan::findOrFail($id);

    $cardPath = public_path($fan->card);

    if (!file_exists($cardPath)) {
        abort(404, "Card not found.");
    }

    // حجم الكارت 8.5 × 5.5 cm = 240pt × 156pt
    $pdf = Pdf::loadView('backend.fans.card_pdf', compact('fan'))
              ->setPaper([0, 0, 240, 156], 'portrait');

    return $pdf->stream("card_{$fan->id}.pdf");
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
