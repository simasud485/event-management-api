<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //User has one to many relationship with bookings and notifications table
    
    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function notifications(){
        return $this->hasMany(Notification::class);
    }
}
