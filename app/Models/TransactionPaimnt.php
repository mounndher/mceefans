<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionPaimnt extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_fan',
        'id_abonment',
        'date',
        'prix',
        'nbrmatch',
    ];
}
