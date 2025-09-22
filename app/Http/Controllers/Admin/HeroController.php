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
        'image'       => 'required|image',
        'button_text' => 'nullable|string',
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
