<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'subtitle',
        'phone',
        'phone_text',
        'phone_icon',
        'email',
        'email_text',
        'email_icon',
        'location',
        'location_text',
        'location_icon',
    ];
}
