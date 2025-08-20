<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;

final readonly class FcmTokenMutation
{
    public function upload($_, array $args)
    {
        $user = Auth::user();

        return $user->fcmTokens()->updateOrCreate(
            ['token' => $args['token']],
            []
        );
    }
}
