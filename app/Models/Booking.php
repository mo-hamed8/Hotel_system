<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table="booking";
    protected $guarded=[];



    public function employee(){
        return $this->belongsTo(User::class);
    }


    public function rooms(){
        return $this->belongsToMany(Booking::class,"booking_room","booking_id","room_id");
    }


}
