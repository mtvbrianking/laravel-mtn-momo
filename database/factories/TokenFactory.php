<?php

use Bmatovu\MtnMomo\Models\Token;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Token::class, function (Faker $faker) {
    return [
        'access_token' => Str::random(60),
        'refresh_token' => Str::random(60),
        'product_type'=> $faker->randomElement(['collection','disbursement','remittance']),
        'token_type' => $faker->randomElement(['Basic', 'Bearer']),
        'expires_at' => $faker->dateTime('now', null)
    ];
});
