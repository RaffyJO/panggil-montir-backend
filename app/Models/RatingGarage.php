<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingGarage extends Model
{
    use HasFactory;

    protected $fillable = [
        "order_id",
        'user_id',
        'garage_id',
        'rating',
        'comment',
        'is_done',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
