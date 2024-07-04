<?php

namespace Database\Seeders;

use App\Models\Garage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GarageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Garage::create([
            'name' => 'Bengkel TK Motor',
            'email' => 'bengkeltk@gmail.com',
            'password' => bcrypt('111111'),
            'phone' => '081289768798',
            'address' => 'RT.005/RW.035, Teluk Pucung, Bekasi Utara, Bekasi, West Java 17121',
            'latitude' => '-6.200574',
            'longitude' => '107.022928',
            'photo' => 'garagetk.jpg',
        ]);

        Garage::create([
            'name' => 'Tira Jaya Motor',
            'email' => 'garage1@example.com',
            'password' => bcrypt('password1'),
            'phone' => '087731430333',
            'address' => 'Jl. KH. Muchtar Tabrani No.6-1, RT.003/RW.012, Perwira, Kec. Bekasi Utara, Kota Bks, Jawa Barat 17124',
            'latitude' => '-6.207596',
            'longitude' => '107.003530',
            'photo' => 'garage1.jpg',
        ]);

        Garage::create([
            'name' => 'Bengkel sari motor',
            'email' => 'garage2@example.com',
            'password' => bcrypt('password2'),
            'phone' => '081267658767',
            'address' => 'Perumahan Taman Wisma Asri 2 Jalan Kampung Irian Blok DD34 # 10 Rt.06/26, RT.004/RW.026, Tlk. Pucung, Kec. Bekasi Utara, Kota Bks, Jawa Barat 17121',
            'latitude' => '-6.203286',
            'longitude' => '107.029369',
            'photo' => 'garage2.jpg',
        ]);

        Garage::create([
            'name' => 'Bengkel motor rumahan',
            'email' => 'garage3@example.com',
            'password' => bcrypt('password3'),
            'phone' => '081353289886',
            'address' => 'Gg. Perwira 4 No.9, RT.005/RW.011, Perwira, Kec. Bekasi Utara, Kota Bks, Jawa Barat 17124',
            'latitude' => '-6.202859',
            'longitude' => '107.014444',
            'photo' => 'garage3.jpg',
        ]);

        Garage::create([
            'name' => 'Bengkel Motor Yoman',
            'email' => 'garage4@example.com',
            'password' => bcrypt('password4'),
            'phone' => '081211418208',
            'address' => 'Central Kaliabang, Bekasi Utara, Bekasi, West Java 17124',
            'latitude' => '-6.205852',
            'longitude' => '107.009857',
            'photo' => 'garage4.jpg',
        ]);

        Garage::create([
            'name' => 'Bengkel Motor Sinar Rejeki Subur',
            'email' => 'garage5@example.com',
            'password' => bcrypt('password5'),
            'phone' => '08128650456',
            'address' => 'Jalan Warung No.mor 45, RT.004/RW.15, Kebalen, Kec. Babelan, Kota Bks, Jawa Barat 17610',
            'latitude' => '-6.189875',
            'longitude' => '107.029055',
            'photo' => 'garage5.jpg',
        ]);
    }
}
