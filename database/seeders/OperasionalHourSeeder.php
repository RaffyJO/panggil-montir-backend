<?php

namespace Database\Seeders;

use App\Models\OperasionalHour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OperasionalHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        for ($garageId = 1; $garageId <= 6; $garageId++) {
            foreach ($days as $day) {
                OperasionalHour::create([
                    'garage_id' => $garageId,
                    'day' => $day,
                    'start_time' => '08:00:00',
                    'end_time' => '17:00:00',
                ]);
            }
        }
    }
}
