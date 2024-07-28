<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'name',
    ];

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
}
