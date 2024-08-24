<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motorcycle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'brand_id',
        'type_id',
        'variant_id',
        'production_year_id',
        'license_plate',
        'is_selected',
    ];

    public function productionYear()
    {
        return $this->belongsTo(ProductionYear::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    protected function casts(): array
    {
        return [
            'is_selected' => 'integer',
        ];
    }
}
