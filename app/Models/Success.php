<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Success extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'descrition',
        'pharse1',
        'textpharse1',
        'pharse2',
        'textpharse2',
        'pharse3',
        'textpharse3',
        'pharse4',
        'textpharse4',
    ];
}
