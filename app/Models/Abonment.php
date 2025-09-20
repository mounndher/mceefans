<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonment extends Model
{
    use HasFactory;
       protected $fillable = [
        'nom',
        'prix',
        'nbrmatch',
        'image',
        'desgin_card',
        'status'
    ];
    public function transactions()
{
    return $this->hasMany(TransactionPaimnt::class, 'id_abonment');
}
public function fans()
{
    return $this->hasMany(Fan::class, 'id_abonment');
}


}
