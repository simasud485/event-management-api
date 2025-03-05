<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    //Booking belongs to User and Event

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo{
        return $this->belongsTo(Event::class);
    }
}
