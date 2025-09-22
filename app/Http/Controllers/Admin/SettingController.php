<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
class SettingController extends Controller
{
    //
    public function index()
    {
        // On récupère le premier enregistrement
        $setting = Setting::first();
        return view('backend.settings.index', compact('setting'));
    }



    // Mettre à jour les paramètres
    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);
        //dd($request->all());

        $request->validate([
            'site_name'    => 'nullable|string|max:255',
            'site_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'site_favicon' => 'nullable|image|mimes:ico,png|dimensions:width=32,height=32',
            'description'  => 'nullable|string|max:500',
        ], [
            'site_logo.image' => 'Le logo doit être une image valide.',
            'site_favicon.image' => 'Le favicon doit être une image valide.',
            'site_favicon.dimensions' => 'Le favicon doit mesurer 32x32 pixels.',
        ]);

        $setting->site_name = $request->site_name;
        $setting->description = $request->description;

        // Gestion du logo
        if ($request->hasFile('site_logo')) {
            $logo = $request->file('site_logo');
            $logoName = time().'_logo.'.$logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/settings/'), $logoName);
            $setting->site_logo = 'uploads/settings/'.$logoName;
        }

        // Gestion du favicon
        if ($request->hasFile('site_favicon')) {
            $favicon = $request->file('site_favicon');
            $faviconName = time().'_favicon.'.$favicon->getClientOriginalExtension();
            $favicon->move(public_path('uploads/settings/'), $faviconName);
            $setting->site_favicon = 'uploads/settings/'.$faviconName;
        }

        $setting->save();

        return redirect()->back()->with('success', 'Paramètres mis à jour avec succès.');
    }
}
