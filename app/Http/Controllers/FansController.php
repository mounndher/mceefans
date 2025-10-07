<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\ImageManagerStatic as Image;

class FansController extends Controller
{
    //
    public function index()
{
    $fans = Fan::latest()->get();
    return view('fans.index', compact('fans'));
}
    public function create()
    {

       return view('create');
    }

    // إضافة كرت جديد
public function store1(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
        ]);

        // create fan (card_number and expiry auto-set in model)
        $fan = Fans::create($data);

        // 1) Generate QR image as PNG binary
        // QR content: you can change to URL or JSON
        $qrContent = route('fan.show', $fan->id); // or "fan:{$fan->id}" or json
        $qrImageBinary = QrCode::format('png')->size(400)->margin(1)->generate($qrContent);

        // Save QR to storage/public/qrcodes/
        $qrPath = 'qrcodes/fan_'.$fan->id.'_'.time().'.png';
        Storage::disk('public')->put($qrPath, $qrImageBinary);

        // 2) Create virtual card image by overlaying onto a base template
        // Put a base template image into public/storage/card_templates/card_base.png
        // Or store it in public/images/card_base.png and read by path

        // Load base template. Example expects storage/app/public/card_templates/card_base.png
        $baseTemplatePath = storage_path('app/public/card_templates/card_base.png');

        // If you don't have a custom base, we can create a simple card background:
        if (!file_exists($baseTemplatePath)) {
            // create a simple blank card 1000x600 with rounded rectangle background (fallback)
            $cardImage = Image::canvas(1000, 600, '#ffffff'); // white background
            // optional: draw rectangle or place graphic
        } else {
            $cardImage = Image::make($baseTemplatePath);
        }

        // Insert QR onto the card
        $qrFullPath = Storage::disk('public')->path($qrPath);
        $qrImg = Image::make($qrFullPath)->resize(220, 220);

        // Example positions — tweak per your template:
        $cardImage->insert($qrImg, 'bottom-right', 40, 40);

        // Add text: name, card number, expiry
        $name = $fan->name;
        $cardNumber = $fan->card_number;
        $expiry = \Carbon\Carbon::parse($fan->card_expires_at)->format('M Y');

        // Choose font size and TTF path (put a .ttf in storage/app/public/fonts/ if needed)
        $fontPath = public_path('fonts/Roboto-Regular.ttf'); // ensure exists or use default built-in

        // Add name
        $cardImage->text($name, 60, 120, function ($font) use ($fontPath) {
            if (file_exists($fontPath)) $font->file($fontPath);
            $font->size(36);
            $font->align('left');
            $font->valign('top');
        });

        // Add card number
        $cardImage->text("ID: {$cardNumber}", 60, 170, function ($font) use ($fontPath) {
            if (file_exists($fontPath)) $font->file($fontPath);
            $font->size(24);
            $font->align('left');
            $font->valign('top');
        });

        // Add expiry
        $cardImage->text("Valid Thru: {$expiry}", 60, 210, function ($font) use ($fontPath) {
            if (file_exists($fontPath)) $font->file($fontPath);
            $font->size(20);
            $font->align('left');
            $font->valign('top');
        });

        // Save card image to storage/public/cards/
        $cardFilename = 'cards/fan_card_'.$fan->id.'_'.time().'.png';
        Storage::disk('public')->put($cardFilename, (string) $cardImage->encode('png', 90));

        // Update fan record with paths
        $fan->update([
            'qr_path' => $qrPath,
            'card_image' => $cardFilename,
        ]);

        return redirect()->route('fan.show', $fan->id)
            ->with('success', 'Fan created and virtual card generated.');
    }




public function store(Request $request)
{
    //dd($request->all());
    // Validate the input
   $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'card_number' => 'required|string|unique:fans,card_number',
            'email' => 'required|email|unique:fans,email',
            ///'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'card_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $request->except('_token'); // Exclude CSRF token

          //if($request->hasFile('image')){
          //  $data['image'] = $request->file('image')->store('fans', 'public');
       // }

        // Upload card image
      //  if($request->hasFile('card_image')){
        //    $data['card_image'] = $request->file('card_image')->store('cards', 'public');
        //}

    // Return back with session data
       $uniqueString = $data['card_number'] . '-' . Str::random(8);
        $data['qr_code'] = QrCode::size(150)->generate($uniqueString);

        // Create Fan
        Fans::create($data);
           return back()->with('success', 'Fan created successfully!');

    }


    public function store2(Request $request)
{
    // 1️⃣ Validate input
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'card_number' => 'required|string|unique:fans,card_number',
        'email' => 'required|email|unique:fans,email',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $data = $request->except('_token');

    // 2️⃣ Handle profile image
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = rand() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);
        $data['image'] = '/uploads/' . $fileName;
    }

    // 3️⃣ Generate QR code
    $uniqueString = $data['card_number'] . '-' . \Str::random(8);
    $qrFileName = $data['card_number'].'_qr.png';
    $uploadsFolder = public_path('uploads');
    if (!file_exists($uploadsFolder)) mkdir($uploadsFolder, 0777, true);
    $qrPath = $uploadsFolder . '/' . $qrFileName;

    $pngData = \QrCode::format('png')->size(100)->generate($uniqueString);
    file_put_contents($qrPath, $pngData);
    $data['qr_code'] = '/uploads/' . $qrFileName;

    // 4️⃣ Create virtual card
    $templatePath = public_path('images/card_template.png');
    $cardFileName = $data['card_number'].'_card.png';
    $cardPath = $uploadsFolder . '/' . $cardFileName;

    $card = imagecreatefrompng($templatePath);
    $cardWidth = imagesx($card);
    $cardHeight = imagesy($card);

    $qr = imagecreatefrompng($qrPath);
    $qrWidth = imagesx($qr);
    $qrHeight = imagesy($qr);

    // Copy QR to card (left-bottom)
    $qrX = 20; // left padding
    $qrY = $cardHeight - $qrHeight - 20; // bottom padding
    imagecopy($card, $qr, $qrX, $qrY, 0, 0, $qrWidth, $qrHeight);

    // 5️⃣ Prepare text settings
    $black = imagecolorallocate($card, 0, 0, 0);
    $fontPath = public_path('fonts/arial.ttf');

    // Helper function for X center
    $centerX = function($text, $fontSize) use ($cardWidth, $fontPath) {
        $box = imagettfbbox($fontSize, 0, $fontPath, $text);
        $textWidth = $box[2] - $box[0];
        return ($cardWidth - $textWidth) / 2;
    };

    // Draw Name (centered)
    $nameFontSize = 40;
    $nameX = $centerX($data['name'], $nameFontSize);
    $nameY = 250; // vertical position
    imagettftext($card, $nameFontSize, 0, $nameX, $nameY, $black, $fontPath, $data['name']);

    // Draw Card Number (centered, below name)
    $numberFontSize = 18;
    $numberX = $centerX($data['card_number'], $numberFontSize);
    $numberY = $nameY + 60; // 60px below name
    imagettftext($card, $numberFontSize, 0, $numberX, $numberY, $black, $fontPath, $data['card_number']);

    // 6️⃣ Save virtual card
    imagepng($card, $cardPath);
    imagedestroy($card);
    imagedestroy($qr);

    $data['card_image'] = '/uploads/' . $cardFileName;

    // 7️⃣ Save fan to database
    \App\Models\Fans::create($data);

    return back()->with('success', 'Fan created successfully with virtual card!');
}






}
