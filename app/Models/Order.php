<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'order_type_id',
        'user_id',
        'motorcycle_id',
        'garage_id',
        'montir_id',
        'payment_id',
        'order_date',
        'booked_date',
        'completed_date',
        'service_fee',
        'delivery_fee',
        'issue',
        'notes',
        'address',
        'latitude',
        'longitude',
        'status',
    ];

    public function orderType()
    {
        return $this->belongsTo(OrderType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }

    public function motorcycle()
    {
        return $this->belongsTo(Motorcycle::class);
    }

    public function montir()
    {
        return $this->belongsTo(Montir::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function services()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
