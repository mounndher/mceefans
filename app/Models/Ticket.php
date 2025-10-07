<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'count',
        'id_qrcode',
        'id_event',
        'price',
        'qr_svg',
        'id_user'


    ];
}
