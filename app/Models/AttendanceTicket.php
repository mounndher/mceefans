<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceTicket extends Model
{
    use HasFactory;
     protected $fillable = [
        'ticket_id',
        'id_event',
        'idappareil',
        'status',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
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
