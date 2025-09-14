<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'fan_id',
        'id_event',
        'idappareil',
        'present',
        'status',
        'date'
    ];
       public function fan()
    {
        return $this->belongsTo(Fan::class, 'fan_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'id_event');
    }

    public function appareil()
    {
        return $this->belongsTo(Appareil::class, 'idappareil');
    }
}
