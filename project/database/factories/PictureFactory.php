<?php

use Faker\Generator as Faker;

$fun = function () {
	$link = str_random(12) . '.jpg';
	$file = file_get_contents('http://lorempicsum.com/futurama/250/250' . rand(1,9));
	Storage::disk('local')->put($link, $file);

	return $link;
};

Storage::cleanDirectory('public/images');

$factory->define(App\Picture::class, function (Faker $faker) use($fun) {
    return [
        
    ];
});
