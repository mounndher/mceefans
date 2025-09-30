<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MatchHighlights;
use Illuminate\Support\Facades\Storage;
class MatchHighlightsController extends Controller
{
    //
      public function index()
    {
        $highlights = MatchHighlights::all();
        return view('backend.match_highlights.index', compact('highlights'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.match_highlights.create');
    }

    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'text' => 'required',
    ]);

    $data = $request->all();

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('uploads/hero/'), $imageName);

        $data['image'] = 'uploads/hero/'.$imageName; // save relative path in DB
    }

    MatchHighlights::create($data);

    return redirect()->route('match_highlights.index')
        ->with('success', 'Surlignement créé avec succès.');
}

    /**
     * Display the specified resource.
     */
    public function show(MatchHighlights $matchHighlight)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MatchHighlights $matchHighlight)
    {
        return view('backend.match_highlights.edit', compact('matchHighlight'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, MatchHighlights $matchHighlight)
{
    $request->validate([
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'text' => 'required',
    ]);

    $data = $request->all();

    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($matchHighlight->image && file_exists(public_path($matchHighlight->image))) {
            unlink(public_path($matchHighlight->image));
        }

        // Upload new image
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('uploads/hero/'), $imageName);

        $data['image'] = 'uploads/hero/'.$imageName; // save relative path
    }

    $matchHighlight->update($data);

    return redirect()->route('match_highlights.index')
        ->with('success', 'Highlight updated successfully.');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MatchHighlights $matchHighlight)
    {
        $matchHighlight->delete();
        return redirect()->route('match_highlights.index')->with('success', 'Highlight deleted successfully.');
    }
}
