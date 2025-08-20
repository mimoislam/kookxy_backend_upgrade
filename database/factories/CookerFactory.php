<?php

namespace Database\Factories;

use App\Models\Cooker;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class CookerFactory extends Factory
{
    protected $model = Cooker::class;

    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'cooker_name' => $this->faker->company,
            'description' => $this->faker->sentence,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'phone' => $this->faker->phoneNumber,
            'admin_commission' => $this->faker->randomFloat(2, 5, 20),
            'active' => true,
            'available_for_delivery' => true,
            'rating' => $this->faker->randomFloat(2, 3, 5),
        ];
    }
}
