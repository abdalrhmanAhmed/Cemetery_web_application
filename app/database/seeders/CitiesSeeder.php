<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            [
                'ar' => 'أبوظبي',
                'en' => 'Abu Dhabi'
            ],
            [
                'ar' => 'دبي',
                'en' => 'Dubai'
            ],
            [
                'ar' => 'الشارقة',
                'en' => 'Sharjah'
            ],
            [
                'ar' => 'عجمان',
                'en' => 'Ajman'
            ],
            [
                'ar' => 'رأس الخيمة',
                'en' => 'Ras Al Khaimah'
            ],
            [
                'ar' => 'الفجيرة',
                'en' => 'Fujairah'
            ],
        ];

        foreach ($cities as $city) {
            \App\Models\City::create(["name" => $city, "country_id" => 1]);
        }
    }
}
