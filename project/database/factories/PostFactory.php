<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$post_type = ['stage', 'formation'];
$status = ['draft', 'published', 'trash'];
$open = [true, false];


$factory->define(App\Post::class, function (Faker $faker) use ($post_type, $status, $open) {
	$begin_at = new Carbon($faker->iso8601());
    return [
        'post_type' => $post_type[array_rand($post_type)],
        'description' => $faker->paragraph(),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 99999,99),
        'max_seats' => $faker->randomDigitNotNull,
        'begin_at' => $begin_at,
        'end_at' => $begin_at->addDays($faker->randomDigitNotNull),
        'status' => $status[array_rand($status)],
        'open' => $open[array_rand($open)]
    ];
});
