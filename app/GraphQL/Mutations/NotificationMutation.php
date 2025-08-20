<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;

final readonly class NotificationMutation
{
    public function markAsRead($_, array $args)
    {
        $user = Auth::user();
        $notification = $user->notifications()->findOrFail($args['id']);
        $notification->update(['read' => true]);

        return $notification;
    }
}
