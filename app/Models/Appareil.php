<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appareil extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'nom_utilisateur']; // allow manual id
    
}
