<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    //
    public function index()
    {
        // On prend le premier enregistrement (car section unique)
        $about = About::first();

        return view('backend.about.index', compact('about'));
    }

    public function update(Request $request, $id)
    {
        $about = About::findOrFail($id);

        // ✅ Validation
        $request->validate([
    'title'       => 'required|string|max:255',
    'title_text'  => 'required|string|max:255',
    'subtitle'    => 'nullable|string|max:255',
    'description' => 'nullable|string',
    'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    'button_text' => 'nullable|string|max:255',
    'button_link' => 'nullable|string|max:255',
], [
    'title.required'      => 'Le champ titre est obligatoire.',
    'title.string'        => 'Le titre doit être une chaîne de caractères.',
    'title.max'           => 'Le titre ne doit pas dépasser 255 caractères.',

    'title_text.required' => 'Le champ texte du titre est obligatoire.',
    'title_text.string'   => 'Le texte du titre doit être une chaîne de caractères.',
    'title_text.max'      => 'Le texte du titre ne doit pas dépasser 255 caractères.',

    'subtitle.string'     => 'Le sous-titre doit être une chaîne de caractères.',
    'subtitle.max'        => 'Le sous-titre ne doit pas dépasser 255 caractères.',

    'description.string'  => 'La description doit être une chaîne de caractères.',

    'image.image'         => "L'image doit être un fichier valide.",
    'image.mimes'         => "L'image doit être au format jpg, jpeg, png ou webp.",
    'image.max'           => "L'image ne doit pas dépasser 2 Mo.",

    'button_text.string'  => 'Le texte du bouton doit être une chaîne de caractères.',
    'button_text.max'     => 'Le texte du bouton ne doit pas dépasser 255 caractères.',

    'button_link.string'  => 'Le lien du bouton doit être une chaîne de caractères.',
    'button_link.max'     => 'Le lien du bouton ne doit pas dépasser 255 caractères.',
]);


        // ✅ Mise à jour des champs
        $about->title = $request->title;
        $about->title_text = $request->title_text;
        $about->subtitle = $request->subtitle;
        $about->description = $request->description;
        $about->button_text = $request->button_text;
        $about->button_link = $request->button_link;

        // ✅ Gestion de l'image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/about/'), $imageName);
            $about->image = 'uploads/about/'.$imageName;
        }

        $about->save();

        return redirect()->route('about.index')->with('success', 'Section About mise à jour avec succès.');
    }
}
