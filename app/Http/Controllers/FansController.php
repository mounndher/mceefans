<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fans;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class FansController extends Controller
{
    //
    public function index()
    {
        $cards = Fans::all();
       return view('index',compact('cards'));
    }
    public function create()
    {
        
       return view('create');
    }

    // إضافة كرت جديد
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'numero' => 'required|string|unique:fans',
        ]);

        // توليد QR Code كـ Base64
        $qrCode = base64_encode(
            QrCode::format('png')->size(200)->generate($request->numero)
        );

        $fan = Fans::create([
            'name'    => $request->name,
            'numero'  => $request->numero,
            'qr_code' => $qrCode,
        ]);
       return redirect()->route('cards.index')->with('success', 'Card created successfully.');
    }

    // عرض كرت واحد
    public function show($id)
    {
        $card = Fans::findOrFail($id);
        return response()->json($card);
    }

    // تحديث كرت
    public function update(Request $request, $id)
    {
        $card = Fans::findOrFail($id);

        $request->validate([
            'name'   => 'sometimes|string',
            'numero' => 'sometimes|string|unique:fans,numero,'.$card->id,
        ]);

        $card->update($request->all());

        return response()->json($card);
    }

    // حذف كرت
    public function destroy($id)
    {
        $card = Fans::findOrFail($id);
        $card->delete();

        return response()->json(['message' => 'Card deleted successfully']);
    }
}
