<?php

use Illuminate\Database\Seeder;

class RegistrationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Registration::class, 100)->create()->each(function (App\Registration $registration) {
            $posts = App\Post::pluck('id')->shuffle();
            $registration->posts()->attach($posts->slice(0, rand(1, $posts->count())));
        });
    }
}
