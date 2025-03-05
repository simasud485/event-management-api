<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //Each event has many bookings
    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
