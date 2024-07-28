<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductionYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('production_years')->insert([
            ['year' => '2014'],
            ['year' => '2015'],
            ['year' => '2016'],
            ['year' => '2017'],
            ['year' => '2018'],
            ['year' => '2019'],
            ['year' => '2020'],
            ['year' => '2021'],
            ['year' => '2022'],
            ['year' => '2023'],
            ['year' => '2024'],
        ]);
    }
}
