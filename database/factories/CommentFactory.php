<?php

use Faker\Generator as Faker;

$factory->define(App\Domain\Comments\Comment::class, function (Faker $faker) {
    return [
        'message' => $faker->realText(50)
    ];
});
