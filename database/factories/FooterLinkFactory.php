<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\FooterLink;
use Faker\Generator as Faker;

$factory->define(FooterLink::class, function (Faker $faker) {
    return [
        'url' => $faker->url(),
        'logo' => 'seeds/footerlink.jpg'
    ];
});
