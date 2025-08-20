<?php
// database/factories/NotificationFactory.php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'body' => $this->faker->paragraph(1),
            'read' => $this->faker->boolean(30),
        ];
    }
}
