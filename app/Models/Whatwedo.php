<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whatwedo extends Model
{
    use HasFactory;
     protected $fillable = [
        'title',
        'subtitle',
        'image1',
        'image2',
        'image3',
        'pharse1',
        'pharse2',
        'pharse3',
    ];

}
