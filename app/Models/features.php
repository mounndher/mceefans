<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class features extends Model
{
    use HasFactory;
      protected $fillable = [
        'title',
        'bigtitle',
        'decription',
        'linge1',
        'subtitle1',
        'linge2',
        'subtitle2',
        'linge3',
        'subtitle3',
        'linge4',
        'subtitle4',
    ];
}
