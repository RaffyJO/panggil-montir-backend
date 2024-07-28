<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID tipe
        $varioId = DB::table('types')->where('name', 'Vario')->value('id');
        $cbrId = DB::table('types')->where('name', 'CBR')->value('id');
        $cbId = DB::table('types')->where('name', 'CB')->value('id');
        $crfId = DB::table('types')->where('name', 'CRF')->value('id');
        $scoopyId = DB::table('types')->where('name', 'Scoopy')->value('id');
        $pcxId = DB::table('types')->where('name', 'PCX')->value('id');
        $goldWingId = DB::table('types')->where('name', 'Gold Wing')->value('id');
        $rebelId = DB::table('types')->where('name', 'Rebel')->value('id');

        DB::table('variants')->insert([
            // Vario variants
            ['type_id' => $varioId, 'name' => '110cc Matic'],
            ['type_id' => $varioId, 'name' => '125cc Matic'],
            ['type_id' => $varioId, 'name' => '150cc Matic'],

            // CBR variants
            ['type_id' => $cbrId, 'name' => '150R Standard'],
            ['type_id' => $cbrId, 'name' => '150R ABS'],
            ['type_id' => $cbrId, 'name' => '250R Standard'],
            ['type_id' => $cbrId, 'name' => '250R ABS'],
            ['type_id' => $cbrId, 'name' => '300R Standard'],
            ['type_id' => $cbrId, 'name' => '500R Standard'],
            ['type_id' => $cbrId, 'name' => '500R ABS'],
            ['type_id' => $cbrId, 'name' => '600RR Standard'],
            ['type_id' => $cbrId, 'name' => '1000RR Standard'],
            ['type_id' => $cbrId, 'name' => '1000RR SP'],
            ['type_id' => $cbrId, 'name' => '1000RR SP2'],

            // CB variants
            ['type_id' => $cbId, 'name' => '125 Standard'],
            ['type_id' => $cbId, 'name' => '150R StreetFire'],
            ['type_id' => $cbId, 'name' => '150R StreetFire ABS'],
            ['type_id' => $cbId, 'name' => '250 Standard'],
            ['type_id' => $cbId, 'name' => '500F Standard'],
            ['type_id' => $cbId, 'name' => '500F ABS'],
            ['type_id' => $cbId, 'name' => '650R Standard'],

            // CRF variants
            ['type_id' => $crfId, 'name' => '150L Standard'],
            ['type_id' => $crfId, 'name' => '250L Standard'],
            ['type_id' => $crfId, 'name' => '300L Standard'],
            ['type_id' => $crfId, 'name' => '450R Standard'],

            // Scoopy variants
            ['type_id' => $scoopyId, 'name' => '110cc Matic'],
            ['type_id' => $scoopyId, 'name' => '125cc Stylish'],
            ['type_id' => $scoopyId, 'name' => '125cc Sporty'],
            ['type_id' => $scoopyId, 'name' => 'eSP Stylish'],
            ['type_id' => $scoopyId, 'name' => 'eSP Sporty'],

            // PCX variants
            ['type_id' => $pcxId, 'name' => '125cc Standard'],
            ['type_id' => $pcxId, 'name' => '125cc ABS'],
            ['type_id' => $pcxId, 'name' => '150cc Standard'],
            ['type_id' => $pcxId, 'name' => '150cc ABS'],
            ['type_id' => $pcxId, 'name' => 'Electric'],

            // Gold Wing variants
            ['type_id' => $goldWingId, 'name' => '1800 Standard'],
            ['type_id' => $goldWingId, 'name' => '1800 Tour'],
            ['type_id' => $goldWingId, 'name' => '2020 Tour'],
            ['type_id' => $goldWingId, 'name' => '2020 DCT'],

            // Rebel variants
            ['type_id' => $rebelId, 'name' => '300 Standard'],
            ['type_id' => $rebelId, 'name' => '500 Standard'],
            ['type_id' => $rebelId, 'name' => '500 ABS'],
        ]);
    }
}
