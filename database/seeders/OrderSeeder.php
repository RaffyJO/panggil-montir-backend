<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            "code"=> "PS-BHLB33Q7NL",
            "order_type_id"=> 1,
            "user_id"=> 1,
            "motorcycle_id"=> 1,
            "garage_id"=> 1,
            "payment_id"=> 1,
            "order_date"=> now(),
            "booked_date"=> "2024-07-01 15:00:00",
            "service_fee"=> 450000,
            "issue"=> "Servis rutin dan ganti oli",
            "notes"=> "Kalo sudah sampai telfon aja yaa",
            "status"=> "completed",
            "address"=> "Jl. Borobudur Agung Tim. VII No.35, Mojolangu, Kec. Lowokwaru, Kota Malang, Jawa Timur 65142",
            "latitude"=> "-6.199722",
            "longitude"=> "107.022883",
        ]);
    }
}
