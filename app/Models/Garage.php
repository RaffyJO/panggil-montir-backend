<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Garage extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'latitude',
        'longitude',
        'photo',
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function operasionalHours()
    {
        return $this->hasMany(OperasionalHour::class);
    }

    public function ratingGarages()
    {
        return $this->hasMany(RatingGarage::class);
    }
}
