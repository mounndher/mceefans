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
        'nom'          => 'required|string',
        'prenom'       => 'required|string',
        'nin'          => 'required|unique:fan|size:18',
        'numero_tele'  => 'required',
        'date_de_nai'  => 'required|date',
        'image'        => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'id_abonment'  => 'required|exists:abonments,id',
    ]);

    $uploadsFolder = public_path('uploads');
    if (!file_exists($uploadsFolder)) mkdir($uploadsFolder, 0777, true);

    // ✅ Generate random ID for fan
    $randomId = $validated['nom'] . '-' . Str::random(6);
    $validated['id_qrcode'] = $randomId;

    // ✅ Generate QR code
    $qrFileName = $randomId . '_qr.png';
    $qrPath = $uploadsFolder . '/' . $qrFileName;
    $pngData = QrCode::format('png')->size(150)->generate($randomId);
    file_put_contents($qrPath, $pngData);
    $validated['qr_img'] = '/uploads/' . $qrFileName;

    // ✅ Upload profile image
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

    // ✅ Get abonment template from public/templates folder
    $abonment = Abonment::findOrFail($request->id_abonment);
  //  $templatePath = public_path('templates/' . $abonment->desgin_card); // <--- ensure templates/ folder
   // $templatePath = storage_path('app/public/card_templates/card_base.png');
    $templatePath = public_path('card_templates/card_base.png');

    //dd(file_exists($templatePath), $templatePath);
    if (!file_exists($templatePath)) {
        return back()->withErrors(['desgin_card' => 'Card template not found at: '.$templatePath]);
    }

    // ✅ Create virtual card
    $card = imagecreatefrompng($templatePath);
    $cardWidth = imagesx($card);
    $cardHeight = imagesy($card);

    // Insert QR code
    $qr = imagecreatefrompng($qrPath);
    $qrWidth = imagesx($qr);
    $qrHeight = imagesy($qr);
    $qrX = 30;
    $qrY = $cardHeight - $qrHeight - 30;
    imagecopy($card, $qr, $qrX, $qrY, 0, 0, $qrWidth, $qrHeight);
    imagedestroy($qr);

    // Insert profile image
    $profileImgPath = public_path($validated['image']);
    $profileExt = strtolower(pathinfo($profileImgPath, PATHINFO_EXTENSION));
    if (in_array($profileExt, ['jpg', 'jpeg'])) {
        $profile = imagecreatefromjpeg($profileImgPath);
    } elseif ($profileExt === 'png') {
        $profile = imagecreatefrompng($profileImgPath);
    } else {
        $profile = imagecreatefromjpeg($profileImgPath);
    }
    $profile = imagescale($profile, 120, 120);
    $profileX = $cardWidth - 150;
    $profileY = 40;
    imagecopy($card, $profile, $profileX, $profileY, 0, 0, 120, 120);
    imagedestroy($profile);

    // Add texts
    $black = imagecolorallocate($card, 0, 0, 0);
    $fontPath = public_path('fonts/arial.ttf');

    // Name
    $nameText = $validated['nom'] . ' ' . $validated['prenom'];
    $nameBox = imagettfbbox(28, 0, $fontPath, $nameText);
    $nameX = ($cardWidth - ($nameBox[2] - $nameBox[0])) / 2;
    $nameY = 250;
    imagettftext($card, 28, 0, $nameX, $nameY, $black, $fontPath, $nameText);

    // NIN
    $ninText = $validated['nin'];
    $ninBox = imagettfbbox(20, 0, $fontPath, $ninText);
    $ninX = ($cardWidth - ($ninBox[2] - $ninBox[0])) / 2;
    $ninY = $nameY + 50;
    imagettftext($card, 20, 0, $ninX, $ninY, $black, $fontPath, $ninText);

    // Numero telephone
    $telText = $validated['numero_tele'];
    $telBox = imagettfbbox(20, 0, $fontPath, $telText);
    $telX = ($cardWidth - ($telBox[2] - $telBox[0])) / 2;
    $telY = $ninY + 40;
    imagettftext($card, 20, 0, $telX, $telY, $black, $fontPath, $telText);

    // Save card
    $cardFileName = $randomId . '_card.png';
    $cardPath = $uploadsFolder . '/' . $cardFileName;
    imagepng($card, $cardPath);
    imagedestroy($card);

    $validated['card'] = '/uploads/' . $cardFileName;

    // ✅ Create fan
    $fan = Fan::create($validated);

    // ✅ Create transaction
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
