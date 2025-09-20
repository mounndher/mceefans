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
   public function index(Request $request)
{
    $query = Fan::where('status', 'active');

    // ✅ البحث
    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function($q) use ($search) {
            $q->where('nom', 'LIKE', "%{$search}%")
              ->orWhere('prenom', 'LIKE', "%{$search}%")
              ->orWhere('numero_tele', 'LIKE', "%{$search}%")
              ->orWhere('nin', 'LIKE', "%{$search}%");
        });
    }

    // ✅ pagination
    $fans = $query->paginate(15);

    // Abonnements actifs
    $abonments = Abonment::where('status','active')->get();

    return view('backend.fans.index', compact('fans','abonments'));
}

  public function bulkPdf(Request $request)
{
    // ✅ Get selected IDs from query string (?ids[]=1&ids[]=2)
    $ids = $request->get('ids', []);

    if (empty($ids)) {
        // If no IDs selected → get all fans
        $fans = Fan::where('status','active');
    } else {
        $fans = Fan::whereIn('id', $ids)->get();
    }

    if ($fans->isEmpty()) {
        return response()->json(['message' => 'No fans found.'], 404);
    }

    // ✅ PDF size (A4 for multiple, or you can keep card size)
    $pdf = Pdf::loadView('backend.fans.bulk_pdf', compact('fans'))
          ->setPaper([0, 0, 240, 156], 'portrait'); // حجم 8.5cm × 5.5cm

    return $pdf->download("fan.pdf");
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
    $pngData = QrCode::format('png')->size(pixels: 67)->generate($randomId);
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
    $qrX = $cardWidth - $qrWidth - 20;
    $qrY = 20;
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
   $profile = imagescale($profile, 130, 130); // adjust exact size
$profileX = 50; // adjust X position
$profileY = 100; // adjust Y position
    imagecopy($card, $profile, $profileX, $profileY, 0, 0, 130, 130);
    imagedestroy($profile);

    // ✅ Text color & font
    $black = imagecolorallocate($card, 0, 0, 0);
    $white = imagecolorallocate($card, 255, 255, 255);
    // ✅ Colors & fonts
$white = imagecolorallocate($card, 255, 255, 255);
$black = imagecolorallocate($card, 0, 0, 0);
$fontRegular = public_path('fonts/Montserrat-Regular.ttf');
$fontSemiBold = public_path('fonts/Montserrat-SemiBold.ttf');

// ———————————————————————————
// Nom
$labelX = 190;       // X position for label
$nameX = 270;        // X position for name
$yNom = 120;         // Y position for Nom line

imagettftext($card, 10, 0, $labelX, $yNom, $white, $fontRegular, 'Nom:');
imagettftext($card, 14, 0, $nameX, $yNom, $white, $fontSemiBold, strtoupper($validated['nom']));

// ———————————————————————————
// Prenom
$yPrenom = 160;      // Y position for Prenom line

imagettftext($card, 10, 0, $labelX, $yPrenom, $white, $fontRegular, 'Prenom:');
imagettftext($card, 14, 0, $nameX + 20, $yPrenom, $white, $fontSemiBold, strtoupper($validated['prenom']));

// ———————————————————————————
// Date d'émission
$yDate = 190;        // Y position for date line
  // X position for Date label
$valueDateX = 350;   // X position for Date value

imagettftext($card, 10, 0, $labelX, $yDate, $white, $fontRegular, 'Date d\'émission:');
imagettftext($card, 14, 0, $nameX + 40, $yDate, $white, $fontSemiBold, $validated['date_de_nai']);

// ———————————————————————————
// ID QR
$yQr = 220;          // Y position for QR line
    // X position for QR label
$valueQrX = 350;     // X position for QR value

$padding = 10; // المسافة من الحافة
$text = $validated['id_qrcode'];
$fontSize = 10;

// نأخذ أبعاد النص
$bbox = imagettfbbox($fontSize, 0, $fontSemiBold, $text);
$textHeight = $bbox[1] - $bbox[7]; // ارتفاع النص

// أبعاد الصورة
$cardWidth = imagesx($card);
$cardHeight = imagesy($card);

// X و Y للزاوية السفلية اليسرى
$x = $padding;
$y = $cardHeight - $padding; // Y من أسفل الصورة مع Padding

// عرض النص
imagettftext($card, $fontSize, 0, $x, $y, $white, $fontRegular, $text);
// Calculate X position based on text width



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
    $pngData2 = QrCode::format('png')->size(pixels: 67)->generate($pdfUrl);
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



public function regenerate(Request $request, $id)
{
    $fan = Fan::findOrFail($id);
    $abonment = Abonment::findOrFail($fan->id_abonment);

    $uploadsFolder = public_path('uploads');
    if (!file_exists($uploadsFolder)) {
        mkdir($uploadsFolder, 0777, true);
    }

    // 🔄 1. Supprimer les anciens fichiers (QR, carte, QR PDF)
    if ($fan->qr_img && file_exists(public_path($fan->qr_img))) {
        unlink(public_path($fan->qr_img));
    }
    if ($fan->card && file_exists(public_path($fan->card))) {
        unlink(public_path($fan->card));
    }
    if ($fan->qr_pdf_img && file_exists(public_path($fan->qr_pdf_img))) {
        unlink(public_path($fan->qr_pdf_img));
    }

    // 🔄 2. Générer nouvel ID QR
    $randomId = $fan->nom . '-' . Str::random(6);
    $fan->id_qrcode = $randomId;

    // 🔄 3. Nouveau QR code
    $qrFileName = $randomId . '_qr.png';
    $qrPath = $uploadsFolder . '/' . $qrFileName;
    $pngData = QrCode::format('png')->size(67)->generate($randomId);
    file_put_contents($qrPath, $pngData);
    $fan->qr_img = '/uploads/' . $qrFileName;

    // 🔄 4. Charger le template de l’abonnement
    $cardTemplatePath = public_path($abonment->desgin_card);
    if (!file_exists($cardTemplatePath)) {
        return back()->withErrors(['desgin_card' => 'Card template not found at ' . $cardTemplatePath]);
    }

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
            return back()->withErrors(['desgin_card' => 'Unsupported template format']);
    }

    // 🔄 5. Ajouter QR
    $qr = imagecreatefrompng($qrPath);
    $qrX = imagesx($card) - imagesx($qr) - 20;
    $qrY = 20;
    imagecopy($card, $qr, $qrX, $qrY, 0, 0, imagesx($qr), imagesy($qr));
    imagedestroy($qr);

    // 🔄 6. Ajouter photo de profil
    $profilePath = public_path($fan->image);
    if (file_exists($profilePath)) {
        $profileExt = strtolower(pathinfo($profilePath, PATHINFO_EXTENSION));
        $profile = $profileExt === 'png'
            ? imagecreatefrompng($profilePath)
            : imagecreatefromjpeg($profilePath);
        $profile = imagescale($profile, 130, 130);
        $profileX = 50;
        $profileY = 100;
        imagecopy($card, $profile, $profileX, $profileY, 0, 0, 130, 130);
        imagedestroy($profile);
    }

    // 🔄 7. Ajouter textes (Nom, Prénom, Date…)
    $white = imagecolorallocate($card, 255, 255, 255);
    $fontRegular = public_path('fonts/Montserrat-Regular.ttf');
    $fontSemiBold = public_path('fonts/Montserrat-SemiBold.ttf');

    // Nom
    $labelX = 190;
    $nameX = 270;
    $yNom = 120;
    imagettftext($card, 10, 0, $labelX, $yNom, $white, $fontRegular, 'Nom:');
    imagettftext($card, 14, 0, $nameX, $yNom, $white, $fontSemiBold, strtoupper($fan->nom));

    // Prénom
    $yPrenom = 160;
    imagettftext($card, 10, 0, $labelX, $yPrenom, $white, $fontRegular, 'Prenom:');
    imagettftext($card, 14, 0, $nameX, $yPrenom, $white, $fontSemiBold, strtoupper($fan->prenom));

    // Date de naissance (ou émission si tu veux)
    $yDate = 190;
    imagettftext($card, 10, 0, $labelX, $yDate, $white, $fontRegular, 'Date d\'émission:');
    imagettftext($card, 14, 0, $nameX + 37, $yDate, $white, $fontSemiBold, $fan->date_de_nai);

    // ID QR (texte en bas)
    $padding = 10;
    $text = $fan->id_qrcode;
    $fontSize = 10;
    $cardHeight = imagesy($card);
    $x = $padding;
    $y = $cardHeight - $padding;
    imagettftext($card, $fontSize, 0, $x, $y, $white, $fontRegular, $text);

    // 🔄 8. Sauvegarde nouvelle carte
    $cardFileName = $randomId . '_card.png';
    $cardPath = $uploadsFolder . '/' . $cardFileName;
    imagepng($card, $cardPath);
    imagedestroy($card);
    $fan->card = '/uploads/' . $cardFileName;

    // 🔄 9. Générer QR vers PDF
    $pdfQrFileName = $randomId . '_pdf_qr.png';
    $pdfQrPath = $uploadsFolder . '/' . $pdfQrFileName;
    $pdfUrl = route('fans.cardPdftelecharger', $fan->id);
    $pngData2 = QrCode::format('png')->size(67)->generate($pdfUrl);
    file_put_contents($pdfQrPath, $pngData2);
    $fan->qr_pdf_img = '/uploads/' . $pdfQrFileName;

    $fan->save();

    return redirect()->back()->with('success', 'Carte et QR régénérés avec succès.');
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
