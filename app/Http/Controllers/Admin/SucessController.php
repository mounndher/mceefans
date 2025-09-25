<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Success;
use Illuminate\Http\Request;

class SucessController extends Controller
{
    //
    public function index()
    {
        $success = Success::first();

        return view('backend.success.index', compact('success'));
    }

    // Update record
    public function update(Request $request,$id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'descrition' => 'nullable|string',
            'pharse1' => 'nullable|string|max:255',
            'textpharse1' => 'nullable|string',
            'pharse2' => 'nullable|string|max:255',
            'textpharse2' => 'nullable|string',
            'pharse3' => 'nullable|string|max:255',
            'textpharse3' => 'nullable|string',
            'pharse4' => 'nullable|string|max:255',
            'textpharse4' => 'nullable|string',
        ]);

        $success = Success::Find($id);

        // handle image upload if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/success/'), $imageName);
            $success->image = 'uploads/success/'.$imageName;
        }

          $success->title       = $request->title;
          $success->subtitle    = $request->subtitle;
          $success->descrition = $request->descrition;
          $success->pharse1 = $request->pharse1;
          $success->textpharse1=$request->textpharse1;
          $success->pharse2 = $request->pharse2;
          $success->textpharse2=$request->textpharse2;
          $success->pharse3 = $request->pharse3;
          $success->textpharse3=$request->textpharse3;
          $success->pharse4 = $request->pharse4;
          $success->textpharse4=$request->textpharse4;
          $success->save();

        return redirect()->route('success.index')->with('success', 'Success section updated successfully.');
    }
}
