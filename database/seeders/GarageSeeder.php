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

        Garage::create([
            'name' => 'Bengkel Jaya Motor',
            'email' => 'garage6@example.com',
            'password' => bcrypt('password6'),
            'phone' => '081234567890',
            'address' => 'Jl. Raya Perjuangan No.10, RT.001/RW.002, Kebalen, Kec. Babelan, Bekasi, Jawa Barat 17610',
            'latitude' => '-6.193503',
            'longitude' => '107.021176',
            'photo' => 'garage6.jpg',
        ]);

        Garage::create([
            'name' => 'Bengkel Maju Jaya',
            'email' => 'garage7@example.com',
            'password' => bcrypt('password7'),
            'phone' => '081278965432',
            'address' => 'Jl. Pahlawan No.8, RT.002/RW.003, Kebalen, Kec. Babelan, Bekasi, Jawa Barat 17610',
            'latitude' => '-6.195342',
            'longitude' => '107.023981',
            'photo' => 'garage7.jpg',
        ]);

        Garage::create([
            'name' => 'Bengkel Baru Motor',
            'email' => 'garage8@example.com',
            'password' => bcrypt('password8'),
            'phone' => '081289765432',
            'address' => 'Jl. Surya Kencana No.12, RT.003/RW.004, Kebalen, Kec. Babelan, Bekasi, Jawa Barat 17610',
            'latitude' => '-6.197543',
            'longitude' => '107.026754',
            'photo' => 'garage8.jpg',
        ]);

        Garage::create([
            'name' => 'Bengkel Motor Terbaik',
            'email' => 'garage9@example.com',
            'password' => bcrypt('password9'),
            'phone' => '081278976543',
            'address' => 'Jl. Melati No.5, RT.004/RW.005, Kebalen, Kec. Babelan, Bekasi, Jawa Barat 17610',
            'latitude' => '-6.199765',
            'longitude' => '107.028976',
            'photo' => 'garage9.jpg',
        ]);

        Garage::create([
            'name' => 'Bengkel Motor Sejahtera',
            'email' => 'garage10@example.com',
            'password' => bcrypt('password10'),
            'phone' => '081234567890',
            'address' => 'Jl. Karya No.6, RT.005/RW.006, Kebalen, Kec. Babelan, Bekasi, Jawa Barat 17610',
            'latitude' => '-6.201234',
            'longitude' => '107.031234',
            'photo' => 'garage10.jpg',
        ]);

        Garage::create([
            'name' => 'Bengkel Motor Berkat Jaya',
            'email' => 'garage11@example.com',
            'password' => bcrypt('password11'),
            'phone' => '081278903210',
            'address' => 'Jl. Wijaya Kusuma No.7, RT.006/RW.007, Kebalen, Kec. Babelan, Bekasi, Jawa Barat 17610',
            'latitude' => '-6.203456',
            'longitude' => '107.033456',
            'photo' => 'garage11.jpg',
        ]);

        Garage::create([
            'name' => 'Bengkel Motor Rizki Jaya',
            'email' => 'garage12@example.com',
            'password' => bcrypt('password12'),
            'phone' => '081290876543',
            'address' => 'Jl. Karya Jasa No.8, RT.007/RW.008, Kebalen, Kec. Babelan, Bekasi, Jawa Barat 17610',
            'latitude' => '-6.205678',
            'longitude' => '107.035678',
            'photo' => 'garage12.jpg',
        ]);

        Garage::create([
            'name' => 'Bengkel Motor Berkah Jaya',
            'email' => 'garage13@example.com',
            'password' => bcrypt('password13'),
            'phone' => '081290876543',
            'address' => 'Jl. Karya Jasa No.8, RT.007/RW.008, Kebalen, Kec. Babelan, Bekasi, Jawa Barat 17610',
            'latitude' => '-6.207890',
            'longitude' => '107.037890',
            'photo' => 'garage13.jpg',
        ]);

        Garage::create([
            'name' => 'Bengkel Motor Amanah Jaya',
            'email' => 'garage14@example.com',
            'password' => bcrypt('password14'),
            'phone' => '081290876543',
            'address' => 'Jl. Karya Jasa No.8, RT.007/RW.008, Kebalen, Kec. Babelan, Bekasi, Jawa Barat 17610',
            'latitude' => '-6.209012',
            'longitude' => '107.039012',
            'photo' => 'garage14.jpg',
        ]);
    }
}
