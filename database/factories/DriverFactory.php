<?php

namespace Database\Factories;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class DriverFactory extends Factory
{
    protected $model = Driver::class;

    public function definition(): array
    {
        return [
            'name'        => $this->faker->firstName(),
            'lastname'    => $this->faker->lastName(),
            'email'       => $this->faker->unique()->safeEmail(),
            'password'    => Hash::make('password'), // default password
            'phone'       => $this->faker->phoneNumber(),
            'type_car'    => $this->faker->randomElement(['Toyota', 'BMW', 'Mercedes', 'Peugeot']),
            'earnings'    => $this->faker->randomFloat(2, 1000, 10000),
            'total_orders'=> $this->faker->numberBetween(0, 200),
            'available'   => $this->faker->boolean(),
            'latitude'    => $this->faker->latitude(35.0, 37.0),   // random Algeria region
            'longitude'   => $this->faker->longitude(-1.0, 3.0),
            'status'      => $this->faker->randomElement(['active','inactive','banned']),
            'points'      => $this->faker->numberBetween(0, 500),
        ];
    }
}
