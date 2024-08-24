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
            "name"=> "Herman Tambal Ban",
            "email"=> "montir1@gmail.com",
            "password"=> "123456",
            "phone"=> "081236787634",
            "licence_plate"=> "B 2833 HGJ",
            "latitude"=> "37.422902703083686",
            "longitude"=> "-122.08337154239418",
            "photo"=> "https://www.w3schools.com/w3images/avatar2.png",
        ]);
    }
}
