<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Montir extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'phone',
        'licence_plate',
        'latitude',
        'longitude',
        'photo',
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
