<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Album;
use Faker\Generator as Faker;

$factory->define(Album::class, function (Faker $faker) {
    return [
        'thumbnail' => 'seeds/album.jpg',
        'title_en' => $faker->word(),
        'title_nl' => $faker->word(),
        'order' => Album::count()
    ];
});
