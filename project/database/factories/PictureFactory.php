<?php

use Faker\Generator as Faker;

/**
 * A function to abstract the downloading step.
 * Loaded on a variable to pass it on the factory scope
 * 
 * @var function
 * @return string ('<hash>.jpg')
 */
function callAPI($url){
   $curl = curl_init();
   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'APIKEY: 111111111111111111111',
      'Content-Type: application/json',
   ));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){die("Connection Failure");}
   curl_close($curl);
   return $result;
};
$dlLoremPixAndReturnLink = function () {
	$api_key='LY6SNqXBxMpxb6bOVDb85GodaUcXD1I2hh7VnxoF';
	// Should not exceed the today's date.
	// APOD of tomorrow is not published yet! ;)
	$y = rand(2015, 2018);
	$m = rand(1, 9);
	$d = rand(1, 20);
	$url= 'https://api.nasa.gov/planetary/apod?date='.$y.'-'.$m.'-'.$d.'&api_key='.$api_key;
	$link = str_random(12) . '.jpg';
	$get_data = callAPI($url);
	$response = json_decode($get_data, true);
	if (isset($response['url'])) {
		$file = file_get_contents($response['url']);
	} else {
		dd($response);
	}
	Storage::disk('local')->put($link, $file);
	echo "\t".$link."\t[".$y."/".$m."/".$d."]\t(".count(Storage::allFiles())."/".Config::get('seed.nb_posts').")\r\n";
	return $link;
};
// We first get all files to count them and/or use their link
$files = Storage::allFiles();

// But as we now have the short pic for them, we want to filter those and only keep the big one.
// It's easy because those are always strings of 16 length.
// Let's filter them and take it in another array.


$filesLink = array_values(array_filter($files, function($fileName) {
	return strlen($fileName) === 16;
}));

/*
	Some custom variables put into $this to make them persistant,
	and not recalculate them at each factory turn ( which make them useless ).
 */
// Are we on the first call of this factory ?
$this->__firstGeneration__ = true;

// Download files cost a lot, so we can not do this regarding to:
// - the custom .env variable to force it,
// - an invalid (too much or not enough) number of pics under public/images
$this->__weShouldCleanStorage__ = env('CLEAN_STORAGE_AT_SEED') || count($files) !== Config::get('seed.nb_posts');

/*
	The real factory stuff.
	Should be easily understandable
	if previous comments have been read.
 */
$factory->define(App\Picture::class, function (Faker $faker) use($dlLoremPixAndReturnLink, $filesLink) {

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
		'link' => $filesLink[App\Picture::all()->last()->id ?? 0],
		'title' => $faker->word,
	];
});


