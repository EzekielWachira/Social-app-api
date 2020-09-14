<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Like;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'post_id' => 1
    ];
});
