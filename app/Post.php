<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
        'title', 'body', 'image'
    ];
//
//    protected $casts = [
//        'user_id' => auth()->user()->id
//    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
