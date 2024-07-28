<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            GarageSeeder::class,
            AddressSeeder::class,
            ServiceSeeder::class,
            OperasionalHourSeeder::class,
            MontirSeeder::class,
            OrderTypeSeeder::class,
            PaymentSeeder::class,
            BrandSeeder::class,
            TypeSeeder::class,
            VariantSeeder::class,
            ProductionYearSeeder::class,
            MotorcycleSeeder::class,
            OrderSeeder::class,
            RatingGarageSeeder::class,
            OrderDetailSeeder::class,
        ]);
    }
}
