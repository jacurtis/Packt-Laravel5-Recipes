<?php

use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    return [
      'title' => $faker->sentence(rand(5, 15), true),
      'description' => $faker->sentences(rand(1,3), true),
      'user_id' => rand(1,5)
    ];
});
