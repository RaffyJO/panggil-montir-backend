<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Garage 1
        $this->createServicesForGarage(1, [
            [
                'name' => 'Oil Change',
                'description' => 'Basic oil change service.',
                'price' => 300000,
                'is_available' => true,
            ],
            [
                'name' => 'Brake Inspection',
                'description' => 'Comprehensive brake system check.',
                'price' => 150000,
                'is_available' => true,
            ],
            [
                'name' => 'Tire Rotation',
                'description' => 'Rotate and balance all tires.',
                'price' => 200000,
                'is_available' => true,
            ],
            [
                'name' => 'Battery Replacement',
                'description' => 'Replace old battery with a new one.',
                'price' => 500000,
                'is_available' => true,
            ],
            [
                'name' => 'Full Motor Service',
                'description' => 'Complete service package including all essential checks and changes.',
                'price' => 1000000,
                'is_available' => true,
            ],
        ]);

        // Garage 2
        $this->createServicesForGarage(2, [
            [
                'name' => 'Engine Tune-Up',
                'description' => 'Optimize engine performance.',
                'price' => 400000,
                'is_available' => true,
            ],
            [
                'name' => 'Air Conditioning Service',
                'description' => 'Check and service the air conditioning system.',
                'price' => 250000,
                'is_available' => true,
            ],
            [
                'name' => 'Transmission Fluid Change',
                'description' => 'Replace transmission fluid and filter.',
                'price' => 350000,
                'is_available' => true,
            ],
            [
                'name' => 'Brake Pad Replacement',
                'description' => 'Replace worn brake pads with new ones.',
                'price' => 180000,
                'is_available' => true,
            ],
            [
                'name' => 'Coolant Flush',
                'description' => 'Flush and replace engine coolant.',
                'price' => 150000,
                'is_available' => true,
            ],
        ]);

        // Garage 3
        $this->createServicesForGarage(3, [
            [
                'name' => 'Wheel Alignment',
                'description' => 'Adjust wheel angles to manufacturer specifications.',
                'price' => 220000,
                'is_available' => true,
            ],
            [
                'name' => 'Spark Plug Replacement',
                'description' => 'Install new spark plugs.',
                'price' => 120000,
                'is_available' => true,
            ],
            [
                'name' => 'Air Filter Replacement',
                'description' => 'Replace engine air filter.',
                'price' => 80000,
                'is_available' => true,
            ],
            [
                'name' => 'Headlight Restoration',
                'description' => 'Restore clarity to foggy headlights.',
                'price' => 100000,
                'is_available' => true,
            ],
            [
                'name' => 'Engine Diagnostics',
                'description' => 'Perform diagnostic tests on engine systems.',
                'price' => 250000,
                'is_available' => true,
            ],
        ]);

        // Garage 4
        $this->createServicesForGarage(4, [
            [
                'name' => 'Suspension Check',
                'description' => 'Inspect and evaluate suspension components.',
                'price' => 180000,
                'is_available' => true,
            ],
            [
                'name' => 'Fuel System Cleaning',
                'description' => 'Clean and maintain fuel injectors and components.',
                'price' => 300000,
                'is_available' => true,
            ],
            [
                'name' => 'Power Steering Fluid Flush',
                'description' => 'Flush and replace power steering fluid.',
                'price' => 150000,
                'is_available' => true,
            ],
            [
                'name' => 'Radiator Flush',
                'description' => 'Flush and replace radiator coolant.',
                'price' => 180000,
                'is_available' => true,
            ],
            [
                'name' => 'Wheel Bearing Replacement',
                'description' => 'Replace worn wheel bearings.',
                'price' => 280000,
                'is_available' => true,
            ],
        ]);

        // Garage 5
        $this->createServicesForGarage(5, [
            [
                'name' => 'Exhaust System Inspection',
                'description' => 'Inspect and diagnose issues with exhaust system.',
                'price' => 100000,
                'is_available' => true,
            ],
            [
                'name' => 'Timing Belt Replacement',
                'description' => 'Replace worn timing belt.',
                'price' => 400000,
                'is_available' => true,
            ],
            [
                'name' => 'Cooling System Service',
                'description' => 'Service and test cooling system components.',
                'price' => 200000,
                'is_available' => true,
            ],
            [
                'name' => 'Cabin Air Filter Replacement',
                'description' => 'Replace cabin air filter.',
                'price' => 80000,
                'is_available' => true,
            ],
            [
                'name' => 'Alternator Replacement',
                'description' => 'Install new alternator.',
                'price' => 500000,
                'is_available' => true,
            ],
        ]);

        // Garage 6
        $this->createServicesForGarage(6, [
            [
                'name' => 'Wheel Tire Balancing',
                'description' => 'Balance all four wheels for smooth operation.',
                'price' => 150000,
                'is_available' => true,
            ],
            [
                'name' => 'Starter Motor Replacement',
                'description' => 'Replace faulty starter motor.',
                'price' => 350000,
                'is_available' => true,
            ],
            [
                'name' => 'Engine Oil Flush',
                'description' => 'Perform engine oil flush and replace with new oil.',
                'price' => 120000,
                'is_available' => true,
            ],
            [
                'name' => 'Electrical System Diagnostics',
                'description' => 'Diagnose and repair electrical system issues.',
                'price' => 280000,
                'is_available' => true,
            ],
            [
                'name' => 'Fuel Filter Replacement',
                'description' => 'Replace clogged fuel filter.',
                'price' => 90000,
                'is_available' => true,
            ],
        ]);
    }

    /**
     * Create services for a specific garage.
     *
     * @param int $garageId
     * @param array $servicesData
     * @return void
     */
    private function createServicesForGarage(int $garageId, array $servicesData): void
    {
        foreach ($servicesData as $serviceData) {
            Service::create([
                'garage_id' => $garageId,
                'name' => $serviceData['name'],
                'description' => $serviceData['description'],
                'price' => $serviceData['price'],
                'is_available' => $serviceData['is_available'],
            ]);
        }
    }
}

