<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mail;
class MailController extends Controller
{
    //
    public function index()
    {
        $mailSettings = Mail::first(); // assuming only one row
        return view('backend.mail-settings.index', compact('mailSettings'));
    }

    // Update mail settings
    public function update(Request $request,$id)
    {
        $request->validate([
            'MAIL_MAILER' => 'required|string',
            'MAIL_HOST' => 'required|string',
            'MAIL_PORT' => 'required|numeric',
            'MAIL_USERNAME' => 'nullable|string',
            'MAIL_PASSWORD' => 'nullable|string',
            'MAIL_ENCRYPTION' => 'nullable|string',
            'MAIL_FROM_ADDRESS' => 'nullable|email',
            'MAIL_FROM_NAME' => 'nullable|string',
        ]);

        $mailSettings = Mail::first();


        $mailSettings->update([
            'MAIL_MAILER' => $request->MAIL_MAILER,
            'MAIL_HOST' => $request->MAIL_HOST,
            'MAIL_PORT' => $request->MAIL_PORT,
            'MAIL_USERNAME' => $request->MAIL_USERNAME,
            'MAIL_PASSWORD' => $request->MAIL_PASSWORD,
            'MAIL_ENCRYPTION' => $request->MAIL_ENCRYPTION,
            'MAIL_FROM_ADDRESS' => $request->MAIL_FROM_ADDRESS,
            'MAIL_FROM_NAME' => $request->MAIL_FROM_NAME,
        ]);

        return redirect()->back()->with('success', 'Mail settings updated successfully.');
    }
}
