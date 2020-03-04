<?php

use Bmatovu\MtnMomo\Models\Token;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Token::class, function (Faker $faker) {
    return [
        'access_token' => Str::random(60),
        'refresh_token' => Str::random(60),
        'token_type' => $faker->randomElement(['Basic', 'Bearer']),
        'product' => $faker->randomElement(['collection', 'disbursement', 'remittance']),
        'expires_at' => $faker->dateTime('now', null),
    ];
});
