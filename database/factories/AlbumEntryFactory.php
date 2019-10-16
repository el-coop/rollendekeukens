<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AlbumEntry;
use Faker\Generator as Faker;

$factory->define(AlbumEntry::class, function (Faker $faker) {
    $entry_type = $faker->randomElement([\App\Models\AlbumPhoto::class, \App\Models\AlbumText::class, \App\Models\AlbumVideo::class]);
    return [
        'image' => 'seeds/albumentry.jpg',
        'entry_type' => $entry_type,
        'entry_id' => factory($entry_type)->create()
    ];
});
