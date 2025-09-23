<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appareil;
class AppareilController extends Controller
{
    //
       public function index()
    {
        $appareils = Appareil::all();
        return view('backend.appareils.index', compact('appareils'));
    }

    public function create()
    {
        return view('backend.appareils.create');
    }
    
    public function getAllAppareils()
    {
        $appareils = Appareil::all();
        return response()->json($appareils);
    }

    public function store(Request $request)
{
    $request->validate([
        'id' => 'required|integer|unique:appareils,id',
        'nom_utilisateur' => 'required|string|max:255',
    ]);

    Appareil::create([
        'id' => $request->id,
        'nom_utilisateur' => $request->nom_utilisateur,
    ]);

    return redirect()->route('appareils.index')->with('success', 'Appareil ajouté avec succès');
}


    public function show(Appareil $appareil)
    {

    }

    public function edit($id)
    {
        $appareil=Appareil::findOrFail($id);
        return view('backend.appareils.edit', compact('appareil'));
    }

    public function update(Request $request, Appareil $appareil)
    {
        $request->validate([
            'nom_utilisateur' => 'required|string|max:255',
        ]);

        $appareil->update($request->all());

        return redirect()->route('appareils.index')->with('success', 'Appareil modifié avec succès');
    }

    public function destroy(Appareil $appareil)
    {
        $appareil->delete();
        return redirect()->route('appareils.index')->with('success', 'Appareil supprimé avec succès');
    }
}
