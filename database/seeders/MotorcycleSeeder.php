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
            'brand' => 'Honda',
            'type' => 'Vario',
            'variant' => 'Matic',
            'production_year' => '2020',
            'is_selected' => true,
        ]);
        Motorcycle::create([
            'user_id' => 1,
            'license_plate' => 'N 4323 JIK',
            'brand' => 'Yamaha',
            'type' => 'Nmax',
            'variant' => 'Matic',
            'production_year' => '2021',
            'is_selected' => false,
        ]);
    }
}
