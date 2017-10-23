<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\User::class, 6)->create();
        // factory(App\Question::class, 30)->create();
        factory(App\Answer::class, 100)->create();
    }
}
