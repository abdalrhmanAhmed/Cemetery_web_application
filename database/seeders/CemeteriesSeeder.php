<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CemeteriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cemeteries = [
            [
                'name' => [
                    'ar' => 'مقبرة الشيخ زايد',
                    'en' => 'Sheikh Zayed Grand Mosque',
                ],
                'latitude' => 24.46667,
                'Longitude' => 54.41667,
                'citiy_id' => 1
            ],
            [
                'name' => [
                    'ar' => 'مقبرة البطين',
                    'en' => 'Al Bateen Cemetery',
                ],
                'latitude' => 24.5,
                'Longitude' => 54.43333,
                'citiy_id' => 1
            ],
            [
                'name' => [
                    'ar' => 'مقبرة الشهداء',
                    'en' => 'Martyrs Cemetery',
                ],
                'latitude' => 25.20000,
                'Longitude' => 55.25000,
                'citiy_id' => 2
            ],
            [
                'name' => [
                    'ar' => 'مقبرة الشارقة',
                    'en' => 'Sharjah Cemetery',
                ],
                'latitude' => 25.31667,
                'Longitude' => 55.36667,
                'citiy_id' => 3
            ],
            [
                'name' => [
                    'ar' => 'مقبرة عجمان',
                    'en' => 'Ajman Cemetery',
                ],
                'latitude' => 25.30000,
                'Longitude' => 55.50000,
                'citiy_id' => 4
            ],
            [
                'name' => [
                    'ar' => 'مقبرة رأس الخيمة',
                    'en' => 'Ras Al Khaimah Cemetery',
                ],
                'latitude' => 25.55000,
                'Longitude' => 55.60000,
                'citiy_id' => 5
            ],
            [
                'name' => [
                    'ar' => 'مقبرة الفجيرة',
                    'en' => 'Fujairah Cemetery',
                    ],
                'latitude' => 25.20000,
                'Longitude' => 55.80000,
                'citiy_id' => 6
            ],
        ];

        foreach ($cemeteries as $cemetery) {
            \App\Models\Cemetery::create($cemetery);
        }
    }
}
