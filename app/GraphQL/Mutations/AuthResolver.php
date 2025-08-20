<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\DriverStatus;
use App\Models\Client;
use App\Models\Driver;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

final readonly class AuthResolver
{
    /** @param  array{}  $args */
    public function signupClient(null $_, array $args)
    {
        $phone = $args['phone'];

        // Check if client exists
        $client = Client::where('phone', $phone)->first();

        if (! $client) {
            // Create new client
            $client = Client::create([
                'phone' => $phone,
      
                'password' => bcrypt(Str::random(10)), // random password
            ]);
        }

        // Issue Sanctum token
        $token = $client->createToken('client_token')->plainTextToken;

        return [
            'user' => $client,
            'token' => $token,
        ];
    }
     public function signupDriver($_, array $args)
    {
        $input = $args['input'];

        // Check if driver already exists
        $exists = Driver::where('email', $input['email'])
            ->orWhere('phone', $input['phone'])
            ->first();

        if ($exists) {
            throw ValidationException::withMessages([
                'email' => ['Driver with this email or phone already exists.'],
            ]);
        }

        // Create driver
        $driver = Driver::create([
            'name'       => $input['name'],
            'lastname'   => $input['lastname'],
            'email'      => $input['email'],
            'phone'      => $input['phone'],
            'password'   => Hash::make($input['password']),
            'type_car'   => $input['type_car'],
            'latitude'   => $input['latitude'] ?? null,
            'longitude'  => $input['longitude'] ?? null,
            'earnings'   => 0,
            'total_orders' => 0,
            'status' => DriverStatus::INACTIVE,
            'available'  => true,
            'points'     => 0,
        ]);

        // Issue token
        $token = $driver->createToken('driver_token')->plainTextToken;

        return [
            'user'  => $driver,
            'token' => $token,
        ];
    }
}
