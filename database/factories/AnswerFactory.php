<?php

use Faker\Generator as Faker;

$factory->define(App\Answer::class, function (Faker $faker) {
    return [
      'question_id' => rand(4, 34),
      'content' => $faker->paragraph(rand(2,5), true),
      'user_id' => rand(1,6),
    ];
});
