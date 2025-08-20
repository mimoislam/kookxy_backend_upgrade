<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cooker extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'cooker_name',
        'description',
        'address',
        'latitude',
        'longitude',
        'phone',
        'admin_commission',
        'active',
        'available_for_delivery',
        'rating',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function images()
{
    return $this->morphMany(Image::class, 'imageable');
}
}
