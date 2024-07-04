<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motorcycle extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_plate',
        'brand',
        'type',
        'variant',
        'production_year',
        'is_selected',
    ];
}
