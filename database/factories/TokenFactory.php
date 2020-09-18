<?php

namespace Bmatovu\MtnMomo\Database\Factories;

use Bmatovu\MtnMomo\Models\Token;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TokenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Token::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'access_token' => Str::random(60),
            'refresh_token' => Str::random(60),
            'token_type' => $this->faker->randomElement(['Basic', 'Bearer']),
            'product' => $this->faker->randomElement(['collection', 'disbursement', 'remittance']),
            'expires_at' => $this->faker->dateTime('now', null),
        ];
    }
}
