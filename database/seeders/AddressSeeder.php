<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Address::create([
            "user_id" => 1,
            "title" => "Rumah",
            "description"=> "Jl. Borobudur Agung Tim. VII No.35, Mojolangu, Kec. Lowokwaru, Kota Malang, Jawa Timur 65142",
            "latitude"=> "-6.199722",
            "longitude"=> "107.022883",
            "notes"=> "Deket samping warung",
            "is_selected"=> true,
        ]);

        Address::create([
            "user_id" => 1,
            "title" => "Rumah Dua",
            "description"=> "Jl. Perjuangan 2 RT.005/RW.035, Teluk Pucung, Bekasi Utara, Bekasi, West Java 17121",
            "latitude"=> "-6.837293",
            "longitude"=> "186.022883",
            "notes"=> null,
            "is_selected"=> false,
        ]);

        Address::create([
            "user_id" => 1,
            "title" => "Rumah Tiga",
            "description"=> "Jl. Perjuangan 2 RT.005/RW.035, Teluk Pucung, Bekasi Utara, Bekasi, West Java 17121",
            "latitude"=> "-6.837293",
            "longitude"=> "186.022883",
            "notes"=> null,
            "is_selected"=> false,
        ]);

        Address::create([
            "user_id" => 1,
            "title" => "Rumah Empat",
            "description"=> "Jl. Perjuangan 2 RT.005/RW.035, Teluk Pucung, Bekasi Utara, Bekasi, West Java 17121",
            "latitude"=> "-6.837293",
            "longitude"=> "186.022883",
            "notes"=> null,
            "is_selected"=> false,
        ]);

        Address::create([
            "user_id" => 1,
            "title" => "Rumah Lima",
            "description"=> "Jl. Perjuangan 2 RT.005/RW.035, Teluk Pucung, Bekasi Utara, Bekasi, West Java 17121",
            "latitude"=> "-6.837293",
            "longitude"=> "186.022883",
            "notes"=> null,
            "is_selected"=> false,
        ]);
    }
}
