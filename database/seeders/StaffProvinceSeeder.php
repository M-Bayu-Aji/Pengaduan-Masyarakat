<?php

namespace Database\Seeders;

use App\Models\StaffProvince;
use App\Models\User;
use Illuminate\Database\Seeder;

class StaffProvinceSeeder extends Seeder
{
    public function run(): void
    {
      
        $provinces = [
            'ACEH' => 'ACEH',
            'SUMUT' => 'SUMATERA UTARA',
            'SUMBAR' => 'SUMATERA BARAT',
            'RIAU' => 'RIAU',
            'JAMBI' => 'JAMBI',
            'SUMSEL' => 'SUMATERA SELATAN',
            'BENGKULU' => 'BENGKULU',
            'LAMPUNG' => 'LAMPUNG',
            'BABEL' => 'BANGKA BELITUNG',
            'KEPRI' => 'KEPULAUAN RIAU',
            'DKI' => 'DKI JAKARTA',
            'JABAR' => 'JAWA BARAT',
            'JATENG' => 'JAWA TENGAH',
            'DIY' => 'DI YOGYAKARTA',
            'JATIM' => 'JAWA TIMUR',
            'BANTEN' => 'BANTEN',
            'BALI' => 'BALI',
            'NTB' => 'NUSA TENGGARA BARAT',
            'NTT' => 'NUSA TENGGARA TIMUR',
            'KALBAR' => 'KALIMANTAN BARAT',
            'KALTENG' => 'KALIMANTAN TENGAH',
            'KALSEL' => 'KALIMANTAN SELATAN',
            'KALTIM' => 'KALIMANTAN TIMUR',
            'KALUT' => 'KALIMANTAN UTARA',
            'SULUT' => 'SULAWESI UTARA',
            'SULTENG' => 'SULAWESI TENGAH',
            'SULSEL' => 'SULAWESI SELATAN',
            'SULTENGG' => 'SULAWESI TENGGARA',
            'GORONTALO' => 'GORONTALO',
            'SULBAR' => 'SULAWESI BARAT',
            'MALUKU' => 'MALUKU',
            'MALUT' => 'MALUKU UTARA',
            'PABAR' => 'PAPUA BARAT',
            'PAPUA' => 'PAPUA'
        ];

        foreach ($provinces as $key => $name) {
            $user = User::where('email', 'head_staff_' . $key . '@gmail.com')->first();

            if ($user) {
                StaffProvince::firstOrCreate(
                    ['user_id' => $user->id],
                    ['province' => $name]
                );
            }
        }
    }
}