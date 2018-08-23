<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Post::class, function (Faker $faker) {

    return [
        'post_type' => $faker->randomElement(['stage', 'formation']),
        'description' => $faker->paragraph(),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 99999,99),
        'max_seats' => $faker->randomDigitNotNull,
        'begin_at' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+6 months'),
        'end_at' => $faker->dateTimeBetween($startDate = '+6 months', $endDate = '+1 years'),
        'status' => $faker->randomElement(['draft', 'published', 'trash']),
        'open' => $faker->randomElement([true, false])
    ];
});
