<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'name'      => $this->faker->firstName(),
            'lastname'  => $this->faker->lastName(),
            'email'     => $this->faker->unique()->safeEmail(),
            'password'  => Hash::make('password'), // default password
            'phone'     => $this->faker->optional()->phoneNumber(),
            'points'    => $this->faker->numberBetween(0, 500),
        ];
    }
}
