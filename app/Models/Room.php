<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table="room";
    protected $guarded=[];

    public function bookings(){
        return $this->belongsToMany(Booking::class,"booking_room","room_id","booking_id");
    }
}
