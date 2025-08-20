<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Client;
use App\Models\Driver;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

final readonly class LoginResolver
{
    /** @param  array{}  $args */
      public function login($_, array $args)
    {
        $input = $args['input'];
        $type = strtolower($input['type']);

        if ($type === 'client') {
            $user = Client::where('email', $input['email'])->first();
        } elseif ($type === 'driver') {
            $user = Driver::where('email', $input['email'])->first();
        } else {
            throw ValidationException::withMessages([
                'type' => ['Invalid type: must be client or driver.'],
            ]);
        }

        if (!$user || !Hash::check($input['password'], $user->password)) {
            throw ValidationException::withMessages([
                'credentials' => ['Invalid email or password.'],
            ]);
        }

        $token = $user->createToken("{$type}_token")->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }
}
