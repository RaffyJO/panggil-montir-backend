<?php

namespace Database\Seeders;

use App\Models\Montir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MontirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Montir::create([
            "name"=> "Montir 1",
            "email"=> "montir1@gmail.com",
            "password"=> "123456",
            "phone"=> "081236787634",
            "licence_plate"=> "B 2833 HGJ",
            "latitude"=> "42.6977",
            "longitude"=> "23.3242",
            "photo"=> "https://www.w3schools.com/w3images/avatar2.png",
        ]);
    }
}
