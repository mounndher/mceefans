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
        $fans = Fan::all();
         //dd($fans); // اختبر لو تحب
        return view('backend.fans.index', compact('fans'));
    }
    public function create()
    {
        $abonments = Abonment::all();
        return view('backend.fans.create',compact('abonments'));
    }

    // Store a new fan

    public function store1(Request $request)
{
    //dd($request->all());
    // ✅ Validate fan fields
    $validated = $request->validate([
        'id_qrcode'    => 'required|unique:fan',
        'nom'          => 'required|string',
        'prenom'       => 'required|string',
        'nin'          => 'required|unique:fan|size:18',
        'numero_tele'  => 'required',
        'date_de_nai'  => 'required|date',
        'image'        => 'nullable|image|mimes:jpg,jpeg,png',
        'imagecart'    => 'nullable|image|mimes:jpg,jpeg,png',
        'card'         => 'nullable|string',

        // ✅ Add abonment selection
        'id_abonment'  => 'required|exists:abonments,id',
    ]);

    // ✅ Create the fan
    $fan = Fan::create($validated);

    // ✅ Get the abonment
    $abonment = Abonment::findOrFail($validated['id_abonment']);

    // ✅ Insert into transaction_paimnts
    TransactionPaimnt::create([
        'id_fan'      => $fan->id,
        'id_abonment' => $abonment->id,
        'date'        => now(),
        'prix'        => $abonment->prix,
        'nbrmatch'    => $abonment->nbrmatch,
    ]);

    return redirect()->route('fans.index')->with('success', 'Fan created successfully with payment transaction.');
}



public function store2(Request $request)
{
    // ✅ Validate input
    $validated = $request->validate([
        'nom'          => 'required|string',
        'prenom'       => 'required|string',
        'nin'          => 'required|unique:fan|size:18',
        'numero_tele'  => 'required',
        'date_de_nai'  => 'required|date',
        'image'        => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'imagecart'        => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'id_abonment'  => 'required|exists:abonments,id',
    ]);

    $uploadsFolder = public_path('uploads');
    if (!file_exists($uploadsFolder)) mkdir($uploadsFolder, 0777, true);

    // ✅ Generate random ID for fan and save in id_qrcode
    $randomId = $validated['nom'] . '-' . Str::random(6);
    $validated['id_qrcode'] = $randomId;

    // ✅ Generate QR code
    $qrFileName = $randomId . '_qr.png';
    $qrPath = $uploadsFolder . '/' . $qrFileName;

    $pngData = QrCode::format('png')->size(150)->generate($randomId);
    file_put_contents($qrPath, $pngData);

    // Save QR code path in card column
    $validated['qr_img'] = '/uploads/' . $qrFileName;

    // ✅ Upload profile image if exists
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = uniqid().'_'.$file->getClientOriginalName();
        $file->move($uploadsFolder, $fileName);
        $validated['image'] = '/uploads/'.$fileName;
    }
    if ($request->hasFile('imagecart')) {
        $file = $request->file('imagecart');
        $fileName = uniqid().'_'.$file->getClientOriginalName();
        $file->move($uploadsFolder, $fileName);
        $validated['imagecart'] = '/uploads/'.$fileName;
    }

    // ✅ Create fan
    $fan = Fan::create($validated);

    // ✅ Create transaction
    $abonment = Abonment::findOrFail($request->id_abonment);
    TransactionPaimnt::create([
        'id_fan'      => $fan->id,
        'id_abonment' => $abonment->id,
        'date'        => now(),
        'prix'        => $abonment->prix,
        'nbrmatch'    => $abonment->nbrmatch,
    ]);

    return redirect()->route('fans.index')
                     ->with('success', 'Fan created successfully with random QR code and transaction.');
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
    $pngData = QrCode::format('png')->size(150)->generate($randomId);
    file_put_contents($qrPath, $pngData);
    $validated['qr_img'] = '/uploads/' . $qrFileName;

    // ✅ Upload profile image
    $profileFile = $request->file('image');
    $profileFileName = uniqid() . '_' . $profileFile->getClientOriginalName();
    $profileFile->move($uploadsFolder, $profileFileName);
    $validated['image'] = '/uploads/' . $profileFileName;

    // ✅ Load card template
    $cardTemplatePath = public_path('card_templates/card_base.png'); // تأكد من مسار القالب ودقته
    if (!file_exists($cardTemplatePath)) {
        return back()->withErrors(['desgin_card' => 'Card template not found']);
    }

    $card = imagecreatefrompng($cardTemplatePath);
    $cardWidth = imagesx($card);
    $cardHeight = imagesy($card);

    // ✅ Insert QR code on card (bottom left with 30px margin)
    $qr = imagecreatefrompng($qrPath);
    $qrWidth = imagesx($qr);
    $qrHeight = imagesy($qr);
    $qrX = 30;
    $qrY = $cardHeight - $qrHeight - 30;
    imagecopy($card, $qr, $qrX, $qrY, 0, 0, $qrWidth, $qrHeight);
    imagedestroy($qr);

    // ✅ Insert profile image (scaled to 120x120, top right corner with margin)
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
    $profile = imagescale($profile, 120, 120);
    $profileX = $cardWidth - 150;
    $profileY = 40;
    imagecopy($card, $profile, $profileX, $profileY, 0, 0, 120, 120);
    imagedestroy($profile);

    // ✅ Text color & font
    $black = imagecolorallocate($card, 0, 0, 0);
    $fontPath = public_path('fonts/arial.ttf');

    // ✅ Add texts with positions (يمكن تعديل المواقع حسب التصميم)

    // Full name (centered horizontally)
    $nameText = strtoupper($validated['nom'] . ' ' . $validated['prenom']);
    $nameBox = imagettfbbox(28, 0, $fontPath, $nameText);
    $nameX = ($cardWidth - ($nameBox[2] - $nameBox[0])) / 2;
    $nameY = 250;
    imagettftext($card, 28, 0, $nameX, $nameY, $black, $fontPath, $nameText);

    // NIN (centered)
    $ninText = $validated['nin'];
    $ninBox = imagettfbbox(20, 0, $fontPath, $ninText);
    $ninX = ($cardWidth - ($ninBox[2] - $ninBox[0])) / 2;
    $ninY = $nameY + 50;
    imagettftext($card, 20, 0, $ninX, $ninY, $black, $fontPath, $ninText);

    // Phone number (centered)
    $telText = $validated['numero_tele'];
    $telBox = imagettfbbox(20, 0, $fontPath, $telText);
    $telX = ($cardWidth - ($telBox[2] - $telBox[0])) / 2;
    $telY = $ninY + 40;
    imagettftext($card, 20, 0, $telX, $telY, $black, $fontPath, $telText);

    // Activity or Role (مثلاً "DÉVELOPPEUR(SE) MOBILE")
    $activityText = 'DÉVELOPPEUR(SE) MOBILE'; // ممكن تعديلها إلى متغير مدخل
    $activityBox = imagettfbbox(18, 0, $fontPath, $activityText);
    $activityX = 30;
    $activityY = $telY + 60;
    imagettftext($card, 18, 0, $activityX, $activityY, $black, $fontPath, $activityText);

    // تاريخ الإصدار - مثال في يمين البطاقة
    $dateIssue = 'Date d\'émission : ' . date('d.m.Y');
    $dateIssueBox = imagettfbbox(16, 0, $fontPath, $dateIssue);
    $dateIssueX = $cardWidth - ($dateIssueBox[2] - $dateIssueBox[0]) - 30;
    $dateIssueY = $cardHeight - 70;
    imagettftext($card, 16, 0, $dateIssueX, $dateIssueY, $black, $fontPath, $dateIssue);

    // تاريخ الصلاحية - مثال أسفل يمين البطاقة
    $dateValid = 'Valide jusqu\'au : ' . date('d.m.Y', strtotime('+5 years'));
    $dateValidBox = imagettfbbox(16, 0, $fontPath, $dateValid);
    $dateValidX = $cardWidth - ($dateValidBox[2] - $dateValidBox[0]) - 30;
    $dateValidY = $cardHeight - 40;
    imagettftext($card, 16, 0, $dateValidX, $dateValidY, $black, $fontPath, $dateValid);

    // ✅ Save final card image
    $cardFileName = $randomId . '_card.png';
    $cardPath = $uploadsFolder . '/' . $cardFileName;
    imagepng($card, $cardPath);
    imagedestroy($card);

    $validated['card'] = '/uploads/' . $cardFileName;

    // ✅ Save fan data to DB
    $fan = Fan::create($validated);

    // ✅ Create associated transaction (تأكد من وجود الموديل والحقول)
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








    // Show a single fan
    public function edit($id)
    {
        $fan = Fan::findOrFail($id);
        return view('backend.fans.edit',compact('fan'));
    }

    // Update fan
    public function update(Request $request, $id)
    {
        $fan = Fan::findOrFail($id);

        $validated = $request->validate([
            'id_qrcode'    => 'sometimes|unique:fan,id_qrcode,' . $fan->id,
            'nin'          => 'sometimes|unique:fan,nin,' . $fan->id,
            'date_de_nai'  => 'sometimes|date',
        ]);

        $fan->update($request->all());

        return response()->json(['message' => 'Fan updated successfully', 'data' => $fan]);
    }

    // Delete fan
    public function destroy($id)
    {
        $fan = Fan::findOrFail($id);
        $fan->delete();

        return response()->json(['message' => 'Fan deleted successfully']);
    }

}
