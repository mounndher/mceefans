<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fan;
class IndexController extends Controller
{
    //

    public function index(Request $request)
{
    // ✅ Validate inputs
    $request->validate([
        'nin' => 'required|string|size:18',
        'numero_tele' => 'required|string|max:20',
    ]);

    // ✅ Check if fan exists
    $fan = Fan::where('nin', $request->nin)
              ->where('numero_tele', $request->numero_tele)
              ->first();

    if (!$fan) {
        return back()->withErrors(['nin' => 'Aucun fan trouvé avec ce NIN et numéro de téléphone.']);
    }

    // ✅ Return to Blade with data
    return view('backend.fans.generate_card1', [
        'fan' => $fan,
        'qr_code_url' => asset($fan->qr_img),
        'card_url' => asset($fan->card),
        'full_name' => $fan->nom . ' ' . $fan->prenom,
    ]);
}

 public function create(){
    return view('backend.fans.generate_card');
 }
 
}
