<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    //
    public function index()
    {
        $contact = Contact::first(); // fetch the first record
        return view('backend.contact.index', compact('contact'));
    }

    // ✅ Show update form
    // public function edit()
    ///  {
    //   $contact = Contact::firstOrFail();
    //  return view('backend.contact.edit', compact('contact'));
    // }

    // ✅ Save updates
    public function update(Request $request, $id)
    {
        $contact = Contact::firstOrFail();

        $request->validate([
            'title'         => 'required|string|max:255',
            'subtitle'      => 'nullable|string|max:255',
            'phone'         => 'required|string|max:255',
            'phone_text'    => 'nullable|string|max:255',
            'phone_icon'    => 'nullable|string|max:255',
            'email'         => 'nullable|max:255',
            'email_text'    => 'nullable|string|max:255',
            'email_icon'    => 'nullable|string|max:255',
            'location'      => 'required|string|max:255',
            'location_text' => 'nullable|string|max:255',
            'location_icon' => 'nullable|string|max:255',
        ], [
            'title.required'    => 'Le titre est obligatoire.',
            'title.string'      => 'Le titre doit être une chaîne de caractères.',
            'phone.required'    => 'Le numéro de téléphone est obligatoire.',
            'phone.string'      => 'Le numéro de téléphone doit être une chaîne de caractères.',
            'email.email'       => "L'adresse e-mail doit être valide.",
            'location.required' => "L'adresse est obligatoire.",
        ]);

        $contact->update($request->all());

        return redirect()->route('contact.index')
            ->with('success', 'Les coordonnées ont été mises à jour avec succès.');
    }
}
