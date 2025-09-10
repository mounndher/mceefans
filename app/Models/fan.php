<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fan extends Model
{
    use HasFactory;
    protected $table = 'fan';
    protected $fillable = [
        'id_qrcode',
        'nom',
        'prenom',
        'image',
        'imagecart',
        'nin',
        'numero_tele',
        'date_de_nai',
        'card',
    ];
}
