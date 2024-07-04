<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "code",
        "thumbnail",
        "status",
    ];

   public function order()
   {
       return $this->hasMany(Order::class);
   }
}
