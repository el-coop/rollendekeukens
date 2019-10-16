<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AlbumVideo;
use Faker\Generator as Faker;

$factory->define(AlbumVideo::class, function (Faker $faker) {
    return [
        'url' => 'https://www.youtube.com/embed/YS5MNK0_X_Q'
    ];
});
