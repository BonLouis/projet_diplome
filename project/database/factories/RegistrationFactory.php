<?php

use Faker\Generator as Faker;

$factory->define(App\Registration::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
    ];
});
