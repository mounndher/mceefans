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



public function store(Request $request)
{
    // ✅ Validate input
    $validated = $request->validate([
        'nom'          => 'required|string',
        'prenom'       => 'required|string',
        'nin'          => 'required|unique:fan|size:18',
        'numero_tele'  => 'required',
        'date_de_nai'  => 'required|date',
        'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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
