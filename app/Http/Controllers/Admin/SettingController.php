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

    // ✅ Validation
    $request->validate([
        'site_name'     => 'nullable|string|max:255',
        'title'         => 'nullable|string|max:255',
        'description'   => 'nullable|string|max:1000',
        'description_site'   => 'nullable|string|max:1000',
        'keywords'      => 'nullable|string|max:1000',

        'facebook_link' => 'nullable|url|max:255',
        'instagram_link'=> 'nullable|url|max:255',
        'tiktok_link'   => 'nullable|url|max:255',
        'maps'          => 'nullable|string',

        'site_logo'     => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        'site_favicon'  => 'nullable|image|mimes:ico,png|dimensions:width=32,height=32',
    ], [
        'site_logo.image'        => 'Le logo doit être une image valide.',
        'site_favicon.image'     => 'Le favicon doit être une image valide.',
        'site_favicon.dimensions'=> 'Le favicon doit mesurer 32x32 pixels.',
        'facebook_link.url'      => 'Le lien Facebook doit être une URL valide.',
        'instagram_link.url'     => 'Le lien Instagram doit être une URL valide.',
        'tiktok_link.url'        => 'Le lien TikTok doit être une URL valide.',
    ]);

    // ✅ Update simple fields
    $setting->site_name      = $request->site_name;
    $setting->title          = $request->title;
    $setting->description    = $request->description;
    $setting->description_site = $request->description_site;
    $setting->keywords       = $request->keywords;
    $setting->facebook_link  = $request->facebook_link;
    $setting->instagram_link = $request->instagram_link;
    $setting->tiktok_link    = $request->tiktok_link;
    $setting->maps           = $request->maps;

    // ✅ Gestion du logo
    if ($request->hasFile('site_logo')) {
        $logo = $request->file('site_logo');
        $logoName = time().'_logo.'.$logo->getClientOriginalExtension();
        $logo->move(public_path('uploads/settings/'), $logoName);
        $setting->site_logo = 'uploads/settings/'.$logoName;

    {
        $setting = Setting::findOrFail($id);






        // ✅ Validation


        $request->validate([


            'site_name' => 'nullable|string|max:255',


            'title' => 'nullable|string|max:255',


            'description' => 'nullable|string|max:1000',


            'description_site' => 'nullable|string|max:1000',


            'keywords' => 'nullable|string|max:1000',





            'facebook_link' => 'nullable|url|max:255',


            'instagram_link' => 'nullable|url|max:255',


            'tiktok_link' => 'nullable|url|max:255',


            'maps' => 'nullable|string',





            'site_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',


            'site_favicon' => 'nullable|image|mimes:ico,png|dimensions:width=32,height=32',


        ], [


            'site_logo.image' => 'Le logo doit être une image valide.',


            'site_favicon.image' => 'Le favicon doit être une image valide.',


            'site_favicon.dimensions' => 'Le favicon doit mesurer 32x32 pixels.',


            'facebook_link.url' => 'Le lien Facebook doit être une URL valide.',


            'instagram_link.url' => 'Le lien Instagram doit être une URL valide.',


            'tiktok_link.url' => 'Le lien TikTok doit être une URL valide.',


        ]);





        // ✅ Update simple fields


        $setting->site_name = $request->site_name;


        $setting->title = $request->title;


        $setting->description = $request->description;


        $setting->description_site = $request->description_site;
        $setting->keywords = $request->keywords;
        $setting->facebook_link = $request->facebook_link;
        $setting->instagram_link = $request->instagram_link;
        $setting->tiktok_link = $request->tiktok_link;
        $setting->maps = $request->maps;
        // ✅ Gestion du logo
        if ($request->hasFile('site_logo')) {
            $logo = $request->file('site_logo');
            $logoName = time() . '_logo.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/settings/'), $logoName);
            $setting->site_logo = 'uploads/settings/' . $logoName;
        }


        // ✅ Gestion du favicon
        if ($request->hasFile('site_favicon')) {
            $favicon = $request->file('site_favicon');


            $faviconName = time() . '_favicon.' . $favicon->getClientOriginalExtension();


            $favicon->move(public_path('uploads/settings/'), $faviconName);


            $setting->site_favicon = 'uploads/settings/' . $faviconName;

        }





        $setting->save();





        return redirect()->back()->with('success', 'Paramètres mis à jour avec succès.');






    }

    // ✅ Gestion du favicon
    if ($request->hasFile('site_favicon')) {
        $favicon = $request->file('site_favicon');
        $faviconName = time().'_favicon.'.$favicon->getClientOriginalExtension();
        $favicon->move(public_path('uploads/settings/'), $faviconName);
        $setting->site_favicon = 'uploads/settings/'.$faviconName;
    }

    $setting->save();

    return redirect()->back()->with('success', 'Paramètres mis à jour avec succès.');
}
}}
