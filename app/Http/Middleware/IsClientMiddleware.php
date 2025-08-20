<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsClientMiddleware
{
     public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user || $user->getTable() !== 'clients') {
            return response()->json(['error' => 'Unauthorized. Must be a client.'], 403);
        }

        return $next($request);
    }
}
