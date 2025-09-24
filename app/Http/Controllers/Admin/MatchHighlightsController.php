<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MatchHighlights;
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
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string',
            'image' => 'nullable|string',
            'text' => 'required|string',
        ]);

        MatchHighlights::create($request->all());

        return redirect()->route('match_highlights.index')->with('success', 'Highlight created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MatchHighlights $matchHighlight)
    {
        return view('match_highlights.show', compact('matchHighlight'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MatchHighlights $matchHighlight)
    {
        return view('match_highlights.edit', compact('matchHighlight'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MatchHighlights $matchHighlight)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string',
            'image' => 'nullable|string',
            'text' => 'required|string',
        ]);

        $matchHighlight->update($request->all());

        return redirect()->route('match_highlights.index')->with('success', 'Highlight updated successfully.');
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
