<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hero;
class HeroController extends Controller
{
    //
    public function index()
{
    $hero = Hero::first(); // fetch first hero
    return view('backend.hero.index', compact('hero'));
}
  public function update(Request $request, $id)
{
   $request->validate([
    'title'       => 'required|string',
    'subtitle'    => 'required|string',
    'image'       => 'nullable|image',
    'button_text' => 'nullable|string',
], [
    'title.required'    => 'Le titre est obligatoire.',
    'title.string'      => 'Le titre doit être une chaîne de caractères.',
    'subtitle.required' => 'Le sous-titre est obligatoire.',
    'subtitle.string'   => 'Le sous-titre doit être une chaîne de caractères.',
    'image.required'    => 'L’image est obligatoire.',
    'image.image'       => 'Le fichier doit être une image (jpg, png, etc).',
    'button_text.string'=> 'Le texte du bouton doit être une chaîne de caractères.',
]);

    // Get first record OR create a new one if not exists
    $hero = Hero::first() ?? new Hero();

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('uploads/hero/'), $imageName);
        $hero->image = 'uploads/hero/'.$imageName;
    }

    $hero->title       = $request->title;
    $hero->subtitle    = $request->subtitle;
    $hero->button_text = $request->button_text;
    $hero->save();

    return redirect()->back()->with('success', 'Héros mis à jour avec succès');
}

}
