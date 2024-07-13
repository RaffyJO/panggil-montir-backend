<?php

namespace Database\Seeders;

use App\Models\OrderDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderDetail::create([
            "order_id"=> 1,
            'service_id' => 1,
        ]);

        OrderDetail::create([
            "order_id"=> 1,
            'service_id' => 2,
        ]);
    }
}
