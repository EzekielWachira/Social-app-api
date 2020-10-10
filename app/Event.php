<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function user() {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }
}
