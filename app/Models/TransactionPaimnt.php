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
    public function fan()
    {
        return $this->belongsTo(Fan::class, 'id_fan');
    }

    public function abonment()
    {
        return $this->belongsTo(Abonment::class, 'id_abonment');
    }
}
