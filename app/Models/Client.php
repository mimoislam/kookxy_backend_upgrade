<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'lastname', 'email', 'password', 'phone', 'points',
    ];

    protected $hidden = [
        'password',
    ];
    public function cooker()
{
    return $this->hasOne(Cooker::class);
}

}
