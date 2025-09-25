<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VotreCart;
class VotreCartController extends Controller
{
    //
    public function index()
    {
        $cart = VotreCart::first();
        return view('backend.votrecart.index', compact('cart'));
    }

    // Mettre à jour une carte spécifique
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $cart = VotreCart::findOrFail($id);

        $cart->title = $request->title;
        $cart->subtitle = $request->subtitle;
        $cart->description = $request->description;

        // Upload image si nouvelle image
       if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();

        // Déplacement vers public/uploads/votrecart
        $image->move(public_path('uploads/votrecart/'), $imageName);

        // Enregistrer le chemin relatif
        $cart->image = 'uploads/votrecart/'.$imageName;
    }

        $cart->save();

        return redirect()->back()->with('success', 'Carte mise à jour avec succès');
    }
}
