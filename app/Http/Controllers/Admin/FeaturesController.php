<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\features;
class FeaturesController extends Controller
{
    //
    public function index() {
    $feature = features::first(); // fetch the first record
    return view('backend.features.index', compact('feature')); // pass it to the view
}
    public function update(Request $request, $id)
{
    // Find the record by ID
    $service = features::findOrFail($id);

    // Validate incoming request
    $request->validate([
        'title'      => 'required|string|max:255',
        'bigtitle'   => 'required|string',
        'decription' => 'required|string',
        'linge1'     => 'required|string',
        'subtitle1'  => 'required|string',
        'linge2'     => 'nullable|string',
        'subtitle2'  => 'nullable|string',
        'linge3'     => 'nullable|string',
        'subtitle3'  => 'nullable|string',
        'linge4'     => 'nullable|string',
        'subtitle4'  => 'nullable|string',
    ]);

    // Fill data
    $data = $request->only([
        'title', 'bigtitle', 'decription',
        'linge1','subtitle1','linge2','subtitle2',
        'linge3','subtitle3','linge4','subtitle4'
    ]);

    // Update record
    $service->update($data);

    // Redirect with success message
    return redirect()->route('features.index')->with('success', 'fonctionnalités mises à jour avec succès !');
}

}
