<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    //Notification belongs to User

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }


}
