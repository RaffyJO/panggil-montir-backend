<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperasionalHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'garage_id',
        'day',
        'start_time',
        'end_time',
    ];
}
