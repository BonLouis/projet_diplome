<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $user = new App\User;
        $user->name = 'admin';
        $user->email = 'admin@admin.admin';
        $user->password = password_hash('admin', PASSWORD_DEFAULT);
        $user->remember_token = str_random(10);
        $user->save();

        $this->call(CategoriesTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(RegistrationsTableSeeder::class);
    }
}
