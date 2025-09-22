<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
class ContactMessageController extends Controller
{
    //
    public function index(){
       $messages = ContactMessage::orderBy('created_at')->paginate(15);
        return view('backend.contact.show', compact('messages'));
    }
        public function store(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'nom'     => 'required|string|max:255',
            'prenom'  => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'message' => 'required|string',
        ], [
            'nom.required'     => 'Le nom est obligatoire.',
            'prenom.required'  => 'Le prénom est obligatoire.',
            'phone.required'   => 'Le numéro de téléphone est obligatoire.',
            'message.required' => 'Le message est obligatoire.',
        ]);

        // ✅ Création du message
        ContactMessage::create([
            'nom'     => $request->nom,
            'prenom'  => $request->prenom,
            'phone'   => $request->phone,
            'message' => $request->message,
        ]);

        // ✅ Retour avec message de succès
        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès !');
    }


}
