<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'guest@gmail.com'],
            [
                'role' => 'guest',
                'password' => Hash::make('tes123')
            ]
        );

        $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
        $apiProvinces = $response->json();

        $provinces = [];
        foreach ($apiProvinces as $province) {
            $key = Str::slug($province['name']);
            $provinces[$key] = $province['name'];
        }

        foreach ($provinces as $key => $name) {
            User::firstOrCreate(
                ['email' => 'head_staff_' . $key . '@gmail.com'],
                [
                    'role' => 'head_staff',
                    'password' => Hash::make('tes123')
                ]
            );
        }
    }
}
