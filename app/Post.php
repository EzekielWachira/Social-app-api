<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function like(){
        return $this->hasMany(Like::class);
    }
    
    public function comment(){
        return $this->hasMany(Comment::class);
    }
}
