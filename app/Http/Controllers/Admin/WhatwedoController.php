<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Whatwedo;
class WhatwedoController extends Controller
{
    //
     public function index()
    {
        $whatwedo = Whatwedo::first(); // if you only have one row
        return view('backend.whatwedos.index', compact('whatwedo'));
    }

    // Update function
   public function update(Request $request, $id)
{
    $whatwedo = Whatwedo::findOrFail($id);

    $request->validate([
        'title'    => 'required|string|max:255',
        'subtitle' => 'required|string|max:255',
        'pharse1'  => 'required|string',
        'pharse2'  => 'required|string',
        'pharse3'  => 'required|string',
        'image1'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'image2'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'image3'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only(['title', 'subtitle', 'pharse1', 'pharse2', 'pharse3']);

    if ($request->hasFile('image1')) {
        $imageName = time() . '_1.' . $request->image1->getClientOriginalExtension();
        $request->image1->move(public_path('uploads/whatwedo'), $imageName);
        $data['image1'] = 'uploads/whatwedo/' . $imageName;
    }

    if ($request->hasFile('image2')) {
        $imageName = time() . '_2.' . $request->image2->getClientOriginalExtension();
        $request->image2->move(public_path('uploads/whatwedo'), $imageName);
        $data['image2'] = 'uploads/whatwedo/' . $imageName;
    }

    if ($request->hasFile('image3')) {
        $imageName = time() . '_3.' . $request->image3->getClientOriginalExtension();
        $request->image3->move(public_path('uploads/whatwedo'), $imageName);
        $data['image3'] = 'uploads/whatwedo/' . $imageName;
    }

    $whatwedo->update($data);

    return redirect()->route('whatwedos.index')->with('success', 'Ce que nous faisons a été mis à jour avec succès !');
}

}
