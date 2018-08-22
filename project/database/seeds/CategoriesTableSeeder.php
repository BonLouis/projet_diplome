<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    private $categories = [
        'html',
        'css',
        'javascript',
        'php',
        'vue',
        'laravel',
        'c',
        'c++',
        'perl',
        'ruby',
        'lolcode',
        'malbolge',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        
        foreach($this->categories as $category) {
            $C = new App\Category;
            $C->name = $category;
            $C->save();
        }
    }
}
