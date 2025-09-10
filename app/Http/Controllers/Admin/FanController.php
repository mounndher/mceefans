<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fan;
use App\Models\TransactionPaimnt;
use App\Models\Abonment;
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
        'id_qrcode'    => 'required|unique:fan',
        'nom'          => 'required|string',
        'prenom'       => 'required|string',
        'nin'          => 'required|unique:fan|size:18',
        'numero_tele'  => 'required',
        'date_de_nai'  => 'required|date',
        'image'        => 'nullable|image|mimes:jpg,jpeg,png',
        'imagecart'    => 'nullable|image|mimes:jpg,jpeg,png',
        'card'         => 'nullable|string',
        'id_abonment'  => 'required|exists:abonments,id',
    ]);

    // ✅ Split fan data (exclude id_abonment)
    $fanData = $request->only([
        'id_qrcode', 'nom', 'prenom', 'nin',
        'numero_tele', 'date_de_nai', 'image', 'imagecart', 'card'
    ]);

    $fan = Fan::create($fanData);

    // ✅ Get abonment
    $abonment = Abonment::findOrFail($request->id_abonment);
    //dd($fan->id);
    // ✅ Insert transaction
    TransactionPaimnt::create([
        'id_fan'      => $fan->id,
        'id_abonment' => $abonment->id,
        'date'        => now(),
        'prix'        => $abonment->prix,
        'nbrmatch'    => $abonment->nbrmatch,
    ]);

    return redirect()->route('fans.index')
                     ->with('success', 'Fan created successfully with payment transaction.');
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
