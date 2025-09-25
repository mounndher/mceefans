<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\fan;
 use Barryvdh\DomPDF\Facade\Pdf;
class IndexController extends Controller
{
    //






    public function update(Request $request, $id){
         'card',
        'qr_img',
        'qr_pdf_img' for this all this is image
    }

public function index(Request $request)
{
    // ✅ Validation des entrées
    $request->validate([
        'nin' => 'required|string|size:18',
        'numero_tele' => 'required|string|max:10',
    ]);

    // ✅ Vérifier si le fan existe
    $fan = Fan::where('nin', $request->nin)
              ->where('numero_tele', $request->numero_tele)
              ->first();

    if (!$fan) {
        return back()->withErrors(['nin' => 'Aucun fan trouvé avec ce NIN et numéro de téléphone.']);
    }

    // ✅ Vérifier si le fichier de carte existe (optionnel)
    $cardPath = public_path($fan->card);
    if (!file_exists($cardPath)) {
        abort(404, "La carte n'existe pas pour ce supporter.");
    }

    // ✅ Générer le PDF depuis une Blade
    $pdf = Pdf::loadView('backend.fans.card_pdf', [
        'fan' => $fan,
        'qr_code_url' => asset($fan->qr_img),
        'card_url' => asset($fan->card),
        'full_name' => $fan->nom . ' ' . $fan->prenom,
    ])->setPaper([0, 0, 240, 156], 'portrait'); // Format 8.5cm × 5.5cm

    // ✅ Télécharger le PDF
    return $pdf->download('carte_supporter_'.$fan->nin.'.pdf');
    // return $pdf->stream('carte_supporter_'.$fan->nin.'.pdf'); // 👉 si tu veux l'ouvrir directement dans le navigateur
}



}
