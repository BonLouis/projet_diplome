<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$titles = ['jQuery','Dojo','Toolkit','React','Zepto','CreateJS','Angular','Ember.js','Vue.js','Meteor','P5.js','Laravel','Phalcon','Symphony','CodeIgniter','CakePHP','Zend','FuelPHP','Slim','Phpixie','Fat-Free','Aura','Ruby on Rails','Sinatra','Padrino','Hanami','Lotus','NYNY','Scorched','Hobbit','Cuba','Crepe','Nancy','Django','Flask','Tornado','Falcon','Hug','Sanic','aiohttp','Pyramid','Growler','CherryPy','MorePath','TurboGears2','Circuits','Watson-framework','Pycnic','WebCore','Reahl'];

$factory->define(App\Post::class, function (Faker $faker) use($titles) {

    return [
        'type' => $faker->randomElement(['stage', 'formation']),
        'title' => $titles[$faker->unique()->numberBetween($min = 0, $max = 49)],
        // 'title' => $faker->word(),
        'description' => $faker->realText(1000),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 99999,99),
        'max_seats' => $faker->numberBetween(50, 1000),
        'begin_at' => $faker->dateTimeBetween('now', '+1 years'),
        'end_at' => $faker->dateTimeBetween('+1 years', '+2 years'),
        'status' => 'published',
        // 'status' => $faker->randomElement(['draft', 'published', 'trash']),
        'open' => $faker->randomElement([true, false])
    ];
});
