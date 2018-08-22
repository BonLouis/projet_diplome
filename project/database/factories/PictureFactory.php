<?php

use Faker\Generator as Faker;

/**
 * A function to abstract the downloading step.
 * Loaded on a variable to pass it on the factory scope
 * 
 * @var function
 * @return string ('<hash>.jpg')
 */
$dlLoremPixAndReturnLink = function () {
	$link = str_random(12) . '.jpg';
	$file = file_get_contents('http://lorempicsum.com/futurama/250/250' . rand(1,9));
	Storage::disk('local')->put($link, $file);

	return $link;
};
// We first get all files to count them and/or use their link
$files = Storage::allFiles();

/*
	Some custom variables put into $this to make them persistant,
	and not recalculate them at each factory turn ( which make them useless ).
 */
// Are we on the first call of this factory ?
$this->__firstGeneration__ = true;

// Download files cost a lot, so we can not do this regarding to:
// - the custom .env variable to force it,
// - an invalid (too much or not enough) number of pics under public/images
$this->__weShouldCleanStorage__ = env('CLEAN_STORAGE_AT_SEED') || count($files) !== 10;


/*
	The real factory stuff.
	Should be easily understandable
	if previous comments have been read.
 */
$factory->define(App\Picture::class, function (Faker $faker) use($dlLoremPixAndReturnLink, $files) {

	if ($this->__weShouldCleanStorage__) {
		if ($this->__firstGeneration__) {
			echo "\n\e[1m\e[33mCLEAN_STORAGE_AT_SEED on .env is true, or the number of images is incorrect. New images will be downloaded.\033[0m\n\n";
			Storage::disk('local')->delete(Storage::allFiles());
			$this->__firstGeneration__ = false;
		}
    	return [
    		'link' => $dlLoremPixAndReturnLink(),
    		'title' => $faker->word,
    	];
	}
	if ($this->__firstGeneration__) {
		echo "\n\e[1m\e[33mThere is enough pictures under public/images. They will be retrieved to feed the db.\033[0m\n\n";
		$this->__firstGeneration__ = false;
    }
    return [
    	//
		'link' => $files[App\Picture::all()->last()->id ?? 0],
		'title' => $faker->word,
	];
});


