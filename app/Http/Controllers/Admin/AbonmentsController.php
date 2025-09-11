<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Abonment;

class AbonmentsController extends Controller
{
    //
    public function index()
    {
        $abonments = Abonment::all();
        return view('backend.abonments.index', compact('abonments'));
    }

    public function create()
    {
        return view('backend.abonments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|string',
            'nbrmatch' => 'required|string',

            'desgin_card' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('desgin_card')) {
            $file = $request->file('desgin_card');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/abonments'), $filename);
            $data['desgin_card'] = 'uploads/abonments/' . $filename; // ✅ store with folder
        }

        Abonment::create($data);

        return redirect()->route('abonments.index')->with('success', 'Abonment created successfully.');
    }

    public function edit($id)
    {
        $abonment = Abonment::findOrFail($id);
        return view('backend.abonments.edit', compact('abonment'));
    }

    public function update(Request $request, $id)
    {
        $abonment = Abonment::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|string',
            'nbrmatch' => 'required|string',

            'desgin_card' => 'nullable',
        ]);

        $data = $request->all();

        if ($request->hasFile('desgin_card')) {
            $file = $request->file('desgin_card');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/abonments'), $filename);
            $data['desgin_card'] = 'uploads/abonments/' . $filename; // ✅ store with folder
        }

        $abonment->update($data);

        return redirect()->route('abonments.index')->with('success', 'Abonment updated successfully.');
    }

    public function destroy($id)
    {
        $abonment = Abonment::findOrFail($id);

        if ($abonment->image && file_exists(public_path('uploads/abonments/' . $abonment->image))) {
            unlink(public_path('uploads/abonments/' . $abonment->image));
        }

        $abonment->delete();

        return redirect()->route('abonments.index')->with('success', 'Abonment deleted successfully.');
    }
}
