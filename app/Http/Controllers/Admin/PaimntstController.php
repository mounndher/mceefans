<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionPaimnt;
class PaimntstController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $query = TransactionPaimnt::with(['fan', 'abonment'])
    ->where('status', 'active'); // eager load fan & abonment

    // 🔍 Search
    if ($request->filled('search')) {
        $search = $request->input('search');

        $query->whereHas('fan', function ($q) use ($search) {
            $q->where('nom', 'like', "%{$search}%")
              ->orWhere('prenom', 'like', "%{$search}%")
              ->orWhere('nin', 'like', "%{$search}%");
        })->orWhereHas('abonment', function ($q) use ($search) {
            $q->where('nom', 'like', "%{$search}%");
        })->orWhere('prix', 'like', "%{$search}%"); // search inside paimnt table
    }

    $paimnts = $query->paginate(15);

    return view('backend.paimnts.index', compact('paimnts'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    
    
    public function moveToHistorique($id)
{
    $paimnt = TransactionPaimnt::findOrFail($id);
    $paimnt->status='historique';
    $paimnt->save();
    return redirect()->route('paimnts.historique')
                     ->with('success', 'Payment moved to historique successfully.');
}

public function annuler($id)
{
    $paimnt = TransactionPaimnt::findOrFail($id);

    $paimnt->update(['status' => 'annule']);

    return redirect()->route('paimnts.index')
                     ->with('success', 'Le paiement a été annulé avec succès.');
}

public function historique(Request $request)
{
    $query = TransactionPaimnt::with(['fan', 'abonment'])
        ->where('status', 'historique'); // ✅ only historique

    // 🔍 Search
    if ($request->filled('search')) {
        $search = $request->input('search');

        $query->where(function ($q) use ($search) {
            $q->whereHas('fan', function ($q2) use ($search) {
                $q2->where('nom', 'like', "%{$search}%")
                   ->orWhere('prenom', 'like', "%{$search}%")
                   ->orWhere('nin', 'like', "%{$search}%");
            })->orWhereHas('abonment', function ($q2) use ($search) {
                $q2->where('nom', 'like', "%{$search}%");
            })->orWhere('prix', 'like', "%{$search}%");
        });
    }

    $paimnts = $query->paginate(15);

    return view('backend.paimnts.historique', compact('paimnts'));
}

}
