<?php
// database/seeders/FcmTokenSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FcmToken;
use App\Models\Client;
use App\Models\Driver;
use App\Models\Cooker;

class FcmTokenSeeder extends Seeder
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
                FcmToken::create([
                    'tokenable_id' => $user->id,
                    'tokenable_type' => $type,
                    'token' => $faker->uuid,
                ]);
            }
        }
    }
}
