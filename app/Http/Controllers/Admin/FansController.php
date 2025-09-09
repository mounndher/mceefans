<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FansController extends Controller
{
    //
    public function index()
    {
        return view('backend.fans.index');
    }
    public function create(){
         return view('backend.fans.create');
    }
    public function store(Request $request){
        // validation
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'nullable|email|unique:fans,email',
            'phone' => 'required|string|max:20',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'imagecarte' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'numero_nationale' => 'required|numeric|digits_between:8,20|unique:fans,numero_nationale',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'nullable|string|max:255',
        ]);

        // handle file upload
        if ($request->hasFile('image')) {
            $imageName = time().'_'.Str::slug($request->nom.'_'.$request->prenom).'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }

        if ($request->hasFile('imagecarte')) {
            $imageCarteName = time().'_carte_'.Str::slug($request->nom.'_'.$request->prenom).'.'.$request->imagecarte->extension();
            $request->imagecarte->move(public_path('images'), $imageCarteName);
        } else {
            $imageCarteName = null;
        }

        // create fan
        \App\Models\Fans::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $imageName,
            'imagecarte' => $imageCarteName,
            'numero_nationale' => $request->numero_nationale,
            'date_naissance' => $request->date_naissance,
            'lieu_naissance' => $request->lieu_naissance,
        ]);

        return redirect()->route('fan.index')->with('success', 'Fan created successfully.');
    }
    public function edit($id){
        return view('backend.fans.edit');
    }
    public function update(Request $request, $id){
        // validation
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'nullable|email|unique:fans,email,'.$id,
            'phone' => 'required|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'imagecarte' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'numero_nationale' => 'required|numeric|digits_between:8,20|unique:fans,numero_nationale,'.$id,
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'nullable|string|max:255',
        ]);

        $fan = \App\Models\Fans::findOrFail($id);

        // handle file upload
        if ($request->hasFile('image')) {
            $imageName = time().'_'.Str::slug($request->nom.'_'.$request->prenom).'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            // delete old image if exists
            if ($fan->image) {
                @unlink(public_path('images/'.$fan->image));
            }
        } else {
            $imageName = $fan->image; // keep old image
        }

        if ($request->hasFile('imagecarte')) {
            $imageCarteName = time().'_carte_'.Str::slug($request->nom.'_'.$request->prenom).'.'.$request->imagecarte->extension();
            $request->imagecarte->move(public_path('images'), $imageCarteName);
            // delete old image if exists
            if ($fan->imagecarte) {
                @unlink(public_path('images/'.$fan->imagecarte));
            }
        } else {
            $imageCarteName = $fan->imagecarte; // keep old image
        }

        // update fan
        $fan->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $request->image]);

    }
    public function destroy($id){
        $fan = \App\Models\Fans::findOrFail($id);
        // delete images if exist
        if ($fan->image) {
            @unlink(public_path('images/'.$fan->image));
        }
        if ($fan->imagecarte) {
            @unlink(public_path('images/'.$fan->imagecarte));
        }
        $fan->delete();
        return redirect()->route('fan.index')->with('success', 'Fan deleted successfully.');
    }
}
