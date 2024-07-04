<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Raffy Jamil Octavialdy',
                'email' => 'raffy@gmail.com',
                'password' => '123456',
                'phone' => '081289766547',
                'point' => 0,
                'photo' => 'admin.jpg',
            ],
            [
                'name' => 'User',
                'email' => 'user@example.com',
                'password' => 'password',
                'phone' => '0987654321',
                'point' => 0,
                'photo' => 'user.jpg',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
