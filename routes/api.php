<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CookerController;

Route::middleware('auth:sanctum')->post('/cookers/signup', [CookerController::class, 'signup']);

