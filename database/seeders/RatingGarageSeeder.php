<?php

namespace Database\Seeders;

use App\Models\RatingGarage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingGarageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RatingGarage::create([
            "order_id"=> 1,
            'user_id' => 1,
            'garage_id' => 1,
            'rating' => 4,
            'comment' => 'Good service and friendly staff.',
            'is_done' => true,
        ]);

        RatingGarage::create([
            "order_id"=> 1,
            'user_id' => 1,
            'garage_id' => 1,
            'rating' => 5,
            'comment' => 'Excellent service! Highly recommend.',
            'is_done' => true,
        ]);
    }
}
