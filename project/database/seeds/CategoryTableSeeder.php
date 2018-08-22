<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Category::insert([
        	['name' => 'html'],
        	['name' => 'css'],
        	['name' => 'javascript'],
        	['name' => 'php'],
        	['name' => 'vue'],
        	['name' => 'laravel'],
        	['name' => 'c'],
        	['name' => 'c++'],
        	['name' => 'perl'],
        	['name' => 'ruby'],
        	['name' => 'lolcode'],
        ]);
    }
}
