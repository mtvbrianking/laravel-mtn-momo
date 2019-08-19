<?php

use Faker\Generator as Faker;
use Bmatovu\MtnMomo\Models\Token;

$factory->define(Token::class, function (Faker $faker) {
    return [
        'access_token' => str_random(60),
        'refresh_token' => str_random(60),
        'token_type' => $faker->randomElement(['Basic', 'Bearer']),
        'expires_at' => $faker->dateTime('now', null),
    ];
});
