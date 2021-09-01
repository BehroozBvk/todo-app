<?php

namespace Database\Seeders;

use App\Models\Article;
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
        \App\Models\User::factory(30)->create()->each(function ($user) {
            if ($user->id == 1)
                $user->update(['name' => 'Administrator', 'is_admin' => true]);
            $user->articles()->saveMany(Article::factory(rand(10, 30))->make());
        });;

    }
}
