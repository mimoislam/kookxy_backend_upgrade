<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\Auth;

final readonly class NotificationQuery
{
    /** @param  array{}  $args */
    public function notifications($root, array $args)
    {
        $user = Auth::user(); // works with sanctum + @guard

        return $user->notifications()->latest();
    }
}
