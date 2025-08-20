<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cooker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CookerController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'address'     => 'required|string',
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
            'phone'       => 'required|string|max:20',
            'images.*'    => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $client = Auth::guard('sanctum')->user();

        if (!$client || $client->getTable() !== 'clients') {
            return response()->json(['error' => 'Only clients can become cookers'], 403);
        }
        
        $cooker = Cooker::create([
            'client_id'   => $client->id,
            'cooker_name'        => $request->name,
            'description' => $request->description,
            'address'     => $request->address,
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
            'phone'       => $request->phone,
            'admin_commission' => 0,
            'active' => true,
            'available_for_delivery' => true,
            'rating' => 0,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('cookers', 'public');
                $cooker->images()->create(['url' => $path]);
            }
        }

        return response()->json([
            'message' => 'Cooker created successfully',
            'cooker'  => $cooker->load('images'),
        ]);
    }
}
