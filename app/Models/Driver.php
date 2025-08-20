<?php

namespace App\Models;

use App\DriverStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'lastname', 'email', 'password', 'phone',
        'type_car', 'earnings', 'total_orders', 'available',
        'latitude', 'longitude', 'status', 'points',
    ];

    protected $hidden = [
        'password',
    ];
    protected $casts = [
    'status' => DriverStatus::class,
];
}
