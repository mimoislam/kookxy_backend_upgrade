<?php

namespace Database\Seeders;

use App\Models\Cooker;
use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Driver;
use App\Models\Image;

class ClientDriverSeeder extends Seeder
{
    public function run(): void
    {


        // Optionally create one known test account
        // Create test client
        $client = Client::factory()->create([
            'name'     => 'Test',
            'lastname' => 'Client',
            'email'    => 'client@test.com',
            'phone' => '+213781092290',

            'password' => bcrypt('password'),
        ]);

        // Create a cooker for this client
        $cooker = Cooker::factory()->create([
            'client_id'   => $client->id,
            'cooker_name' => 'Test Cooker',
            'description' => 'This is a test cooker for the test client',
            'address'     => '123 Test Street',
            'latitude'    => 36.7528,
            'longitude'   => 3.0422,
            'phone'       => '+213600000000',
            'admin_commission' => 10,
            'active'      => true,
            'available_for_delivery' => true,
            'rating'      => 4.5,
        ]);

        // Attach some demo images to this cooker
        $cooker->images()->saveMany(
            Image::factory()->count(3)->make()
        );

        // Also seed some random cookers with clients
        $this->call([
            CookerSeeder::class,
        ]);

        Driver::factory()->create([
            'name' => 'Test',
            'lastname' => 'Driver',
            'email' => 'driver@test.com',
            'phone' => '+213781092290',
            'password' => bcrypt('password'),
            'type_car' => 'Toyota',
            'status' => 'active',
        ]);

                // Create 20 clients
        Client::factory(3)->create();

        // Create 10 drivers
        Driver::factory(5)->create();
    }
}
