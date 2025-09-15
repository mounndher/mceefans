<?php

namespace App\Http\Controllers;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Exception;
class WhatsappController extends Controller
{
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


}
