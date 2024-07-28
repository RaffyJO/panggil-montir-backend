<?php

namespace Database\Seeders;

use App\Models\Motorcycle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MotorcycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Motorcycle::create([
            'user_id' => 1,
            'license_plate' => 'B 5216 KHY',
            'brand_id' => 1,
            'type_id' => 1,
            'variant_id' => 1,
            'production_year_id' => 1,
            'is_selected' => true,
        ]);
        Motorcycle::create([
            'user_id' => 1,
            'license_plate' => 'N 4323 JIK',
            'brand_id' => 1,
            'type_id' => 2,
            'variant_id' => 2,
            'production_year_id' => 2,
            'is_selected' => false,
        ]);
    }
}
