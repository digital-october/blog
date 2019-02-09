<?php

use Faker\Generator as Faker;

$factory->define(App\Domain\Posts\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->words(random_int(1, 5), true),
        'content' => $faker->realText(200, 2),

    ];
});
