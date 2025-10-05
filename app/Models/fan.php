<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fan extends Model
{
    use HasFactory;
    protected $table = 'fan';
    protected $fillable = [
        'id_qrcode',
        'id_abonment',
        'nom',
        'prenom',
        'image',
        'imagecart',
        'nin',
        'numero_tele',
        'date_de_nai',
        'card',
        'qr_img',
        'qr_pdf_img',
        'created_by'
    ];
    public function transactions()
{
    return $this->hasMany(TransactionPaimnt::class, 'id_fan');
}
public function latestTransaction()
{
    return $this->hasOne(TransactionPaimnt::class, 'id_fan')->latestOfMany();

}
public function events()
{
    return $this->belongsToMany(Event::class, 'attendances', 'fan_id', 'id_event');
}
public function abonment()
{
    return $this->belongsTo(Abonment::class, 'id_abonment');
}
public function getRemainingMatchesAttribute()
{
    $totalMatches = $this->transactions()->sum('nbrmatch');

    $usedMatches = Attendance::where('fan_id', $this->id)
        ->whereIn('status', ['checked_in', 'absent'])
        ->count();

    return max($totalMatches - $usedMatches, 0);
}

public function getPaymentStatusAttribute()


{


    $lastTransaction = $this->latestTransaction;


    return $lastTransaction ? $lastTransaction->statusp : 'nonp';


}


public function creator()
{
    return $this->belongsTo(User::class, 'created_by');
}


}
