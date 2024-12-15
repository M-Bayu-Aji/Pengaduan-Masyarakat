<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'guest@gmail.com',
            'role' => 'guest',
            'password' => Hash::make('guest123')
        ]);

        $provinces = [
            'jabar',
            'jatim',
            'jateng'
        ];

        foreach ($provinces as $province) {
            User::create([
                'email' => 'head_staff_' . $province . '@gmail.com',
                'role' => 'head_staff',
                'password' => Hash::make('tes123')
            ]);
        }
    }
}
