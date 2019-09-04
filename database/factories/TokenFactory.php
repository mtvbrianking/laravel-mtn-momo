<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Bmatovu\MtnMomo\Models\Token;

$factory->define(Token::class, function (Faker $faker) {
    return [
        'access_token' => Str::random(60),
        'refresh_token' => Str::random(60),
        'token_type' => $faker->randomElement(['Basic', 'Bearer']),
        'expires_at' => $faker->dateTime('now', null),
    ];
});
