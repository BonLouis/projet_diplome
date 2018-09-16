<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Post::class, Config::get('seed.nb_posts'))->create()->each(function (App\Post $post) {
            $categories = App\Category::pluck('id')->shuffle();

            $post->categories()->attach($categories->slice(0, rand(1, 4)));
            $post->picture()->save(factory(App\Picture::class)->make());
        });
    }
}
