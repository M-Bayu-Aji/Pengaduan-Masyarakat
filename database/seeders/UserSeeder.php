<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        
        $provinces = [
            'aceh' => 'Aceh',
            'sumut' => 'Sumatera Utara',
            'sumbar' => 'Sumatera Barat',
            'riau' => 'Riau',
            'jambi' => 'Jambi',
            'sumsel' => 'Sumatera Selatan',
            'bengkulu' => 'Bengkulu',
            'lampung' => 'Lampung',
            'babel' => 'Kepulauan Bangka Belitung',
            'kepri' => 'Kepulauan Riau',
            'jakarta' => 'DKI Jakarta',
            'jabar' => 'Jawa Barat',
            'jateng' => 'Jawa Tengah',
            'yogya' => 'DI Yogyakarta',
            'jatim' => 'Jawa Timur',
            'banten' => 'Banten',
            'bali' => 'Bali',
            'ntb' => 'Nusa Tenggara Barat',
            'ntt' => 'Nusa Tenggara Timur',
            'kalbar' => 'Kalimantan Barat',
            'kalteng' => 'Kalimantan Tengah',
            'kalsel' => 'Kalimantan Selatan',
            'kaltim' => 'Kalimantan Timur',
            'kalut' => 'Kalimantan Utara',
            'sulut' => 'Sulawesi Utara',
            'sulteng' => 'Sulawesi Tengah',
            'sulsel' => 'Sulawesi Selatan',
            'sultengg' => 'Sulawesi Tenggara',
            'gorontalo' => 'Gorontalo',
            'sulbar' => 'Sulawesi Barat',
            'maluku' => 'Maluku',
            'malut' => 'Maluku Utara',
            'papuabarat' => 'Papua Barat',
            'papua' => 'Papua'
        ];

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
