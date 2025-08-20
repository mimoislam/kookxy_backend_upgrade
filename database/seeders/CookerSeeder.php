<?php

namespace Database\Seeders;

use App\Models\Cooker;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CookerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cooker::factory()
            ->count(5)
            ->create()
            ->each(function ($cooker) {
                // Attach 3 random images to each cooker
                $cooker->images()->saveMany(
                    Image::factory()->count(3)->make()
                );
            });
    }
}
