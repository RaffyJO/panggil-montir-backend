<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::create([
            "name" => "Cash",
            "code" => "cash",
            "thumbnail" => "https://i.ibb.co/4b2r0tX/cash.png",
            "status" => "active",
        ]);

        Payment::create([
            "name" => "Credit Card",
            "code" => "credit_card",
            "thumbnail" => "https://i.ibb.co/4b2r0tX/credit-card.png",
            "status" => "active",
        ]);

        Payment::create([
            "name" => "Debit Card",
            "code" => "debit_card",
            "thumbnail" => "https://i.ibb.co/4b2r0tX/debit-card.png",
            "status" => "active",
        ]);

        Payment::create([
            "name" => "Net Banking",
            "code" => "net_banking",
            "thumbnail" => "https://i.ibb.co/4b2r0tX/net-banking.png",
            "status" => "active",
        ]);
    }
}
