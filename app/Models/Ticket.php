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
        'ticket_number',
        'qr_svg',
        'id_user',
        'status',


    ];
    public function attendanceTickets()
{
    return $this->hasMany(AttendanceTicket::class, 'ticket_id');
}
public function event()
{
    return $this->belongsTo(Event::class, 'id_event');
}
 public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
