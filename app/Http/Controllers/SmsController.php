<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
class SmsController extends Controller
{
    //
    public function sendsms(){


    $sid    = getenv('TWILIO_SID');
    $token  =  getenv('TWILIO_TOKEN');
    $sendernumbr=getenv('TWILIO_PHONE');

    $twilio = new Client($sid, $token);
    $message = $twilio->messages
      ->create("+213796790390", // to
        array(
          "messagingServiceSid" => "MG26a2b13f76d45f352e0e006456e15fbb",
          "body" => "https://mceefans.consubat.com/fans/5/cardtelecharger",
          "from" =>$sendernumbr
        )
      );
      dd("message send successfull");

    }
}
