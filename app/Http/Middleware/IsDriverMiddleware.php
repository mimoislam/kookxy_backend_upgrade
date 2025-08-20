<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsDriverMiddleware
{
   public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user || $user->getTable() !== 'drivers') {
            return response()->json(['error' => 'Unauthorized. Must be a driver.'], 403);
        }

        return $next($request);
    }
}
