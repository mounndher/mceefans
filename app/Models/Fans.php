<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
class Fans extends Model
{
    use HasFactory;

protected $fillable = [
    'name', 'email', 'phone', 'card_number', 'image', 'qr_code', 'card_image'
];


  //  protected static function booted()
    //{
      //  static::creating(function ($fan) {
       //     // Generate random card number
        //    $fan->card_number = 'FAN-' . strtoupper(Str::random(8));

            // Set expiry 1 year (or 2 years) from now
         //   $fan->card_expires_at = Carbon::now()->addYears(1);
       // });
   // }
}
