<?php

namespace App\Http\Middleware;

use App\Models\Cooker;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsClientCookerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user || $user->getTable() !== 'clients') {
            return response()->json(['error' => 'Unauthorized. Must be a client.'], 403);
        }

        // check if this client is already a cooker
        $isCooker = Cooker::where('client_id', $user->id)->exists();

        if (!$isCooker) {
            return response()->json(['error' => 'Unauthorized. Must be a client with cooker .'], 403);
        }

        return $next($request);
    }
}
