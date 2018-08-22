<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Post::class, 10)->create()->each(function (App\Post $post) {
			$categories = App\Category::pluck('id')->shuffle();
        	$post->categories()->attach($categories->slice(0, rand(1, $categories->count())));
			// dump($post);
        });
    }
}
