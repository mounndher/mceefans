<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MatchHighlightsText;
class MatchHighlightsTextController extends Controller
{
    //
    public function index()
    {
        $highlightText = MatchHighlightsText::first();

        return view('backend.match_highlights_text.index', compact('highlightText'));
    }

    // Update the first record
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string',
        ]);

        $highlightText = MatchHighlightsText::first();

        if (!$highlightText) {
            $highlightText = MatchHighlightsText::create($request->only(['title', 'subtitle']));
        } else {
            $highlightText->update($request->only(['title', 'subtitle']));
        }

        return redirect()->route('match_highlights_text.index')
            ->with('success', 'Match Highlights Text updated successfully.');
    }
}
