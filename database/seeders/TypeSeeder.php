<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID brand Honda
        $brandId = DB::table('brands')->where('name', 'Honda')->value('id');
            
        DB::table('types')->insert([
            ['brand_id' => $brandId, 'name' => 'Vario'],
            ['brand_id' => $brandId, 'name' => 'CBR'],
            ['brand_id' => $brandId, 'name' => 'CB'],
            ['brand_id' => $brandId, 'name' => 'CRF'],
            ['brand_id' => $brandId, 'name' => 'Scoopy'],
            ['brand_id' => $brandId, 'name' => 'PCX'],
            ['brand_id' => $brandId, 'name' => 'Gold Wing'],
            ['brand_id' => $brandId, 'name' => 'Rebel'],
        ]);
    }
}
