<?php

use Faker\Generator as Faker;



$factory->define(\App\Thread::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory ('App\User')->create()->id;
        },
        'channel_id' => function() {
            return factory(\App\Channel::class)->create()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraph
    ];
});


$factory->define(\App\Reply::class, function (Faker $faker) {
    return [
        'thread_id' => function () {
            return factory (\App\Thread::class)->create()->id;
        },
        'user_id' => function () {
            return factory ('App\User')->create()->id;
        },
        'body' => $faker->paragraph
    ];
});


$factory->define(\App\Channel::class, function (Faker $faker) {
    return [
      'name' => $faker->word,
      'slug' => $faker->word
    ];
});