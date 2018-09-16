<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Post::class, function (Faker $faker) {

    return [
        'type' => $faker->randomElement(['stage', 'formation']),
        'title' => $faker->word(),
        'description' => $faker->realText(1000),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 99999,99),
        'max_seats' => $faker->numberBetween(50, 1000),
        'begin_at' => $faker->dateTimeBetween('-6 months', '+6 months'),
        'end_at' => $faker->dateTimeBetween('+6 months', '+1 years'),
        'status' => 'published',
        // 'status' => $faker->randomElement(['draft', 'published', 'trash']),
        'open' => $faker->randomElement([true, false])
    ];
});
