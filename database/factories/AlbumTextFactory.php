<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AlbumText;
use Faker\Generator as Faker;

$factory->define(AlbumText::class, function (Faker $faker) {
    return [
        'text_en' => $faker->paragraph(),
        'text_nl' => $faker->paragraph()
    ];
});
