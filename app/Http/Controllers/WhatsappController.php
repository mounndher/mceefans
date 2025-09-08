<?php

namespace App\Http\Controllers;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Exception;
class WhatsappController extends Controller
{

     public function index()
 {
  return view('whatsapp');
 }
 // Method to handle form submission and send a WhatsApp message via Twilio
 function store(Request $request)
 {
        // Note: Both 'from' and 'to' numbers should be formatted as:
        // whatsapp:+CountryCodePhoneNumber (e.g., whatsapp:+123456789)
        // Get Twilio credentials and WhatsApp number from environment variables
  $twilioSid = env('TWILIO_SID');
  $twilioAuthToken = env('TWILIO_AUTH_TOKEN');
  $twilioWhatsappNumber = 'whatsapp:'.env('TWILIO_WHATSAPP_NUMBER');
  // Get the recipient's WhatsApp number and message content from the request
  $to = 'whatsapp:'.$request->phone;
  $message = $request->message;
  // Create a new Twilio client using the SID and Auth Token
  $client = new Client($twilioSid, $twilioAuthToken);
  try {
   // Send the WhatsApp message using Twilio's API
   $message = $client->messages->create(
    $to,
    array(
     'from' => $twilioWhatsappNumber,
     'body' => $message
    )
   );
   // Return success message with the message SID for reference
   return "Message sent successfully! SID: " . $message->sid;
  } catch (Exception $e) {
    // Catch any errors and return the error message
   return "Error sending message: " . $e->getMessage();
  }

}
}
