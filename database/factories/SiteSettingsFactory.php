<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\SiteSetting::class, function (Faker $faker) {
    return [
        'key' => $faker->word(),
        'value' => $faker->word()
    ];
});
