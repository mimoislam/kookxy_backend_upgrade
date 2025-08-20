<?php
// database/seeders/NotificationSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\Client;
use App\Models\Driver;
use App\Models\Cooker;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $users = [
            'App\\Models\\Client' => Client::all(),
            'App\\Models\\Driver' => Driver::all(),
            'App\\Models\\Cooker' => Cooker::all(),
        ];

        foreach ($users as $type => $collection) {
            foreach ($collection as $user) {
                Notification::factory()->count(5)->create([
                    'notifiable_id' => $user->id,
                    'notifiable_type' => $type,
                ]);
            }
        }
    }
}
