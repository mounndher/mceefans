<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
     protected $fillable = [
        'nom',
        'subtitle',
        'image_post',
        'date',
        'stade',
        'status'
    ];
   public function fans()
{
    return $this->belongsToMany(Fan::class, 'attendances', 'id_event', 'fan_id');
}
}
