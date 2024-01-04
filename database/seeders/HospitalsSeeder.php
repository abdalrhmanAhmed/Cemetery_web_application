<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HospitalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hospitals = [
            [
                'ar' => 'مستشفى خليفة العام',
                'en' => 'Khalifa General Hospital',
            ],
            [
                'ar' => 'مستشفى ميدكلينيك بارك فيو',
                'en' => 'Medcare Park View Hospital',
            ],
            [
                'ar' => 'مستشفى الكورنيش',
                'en' => 'Corniche Hospital',
            ],
            [
                'ar' => 'مستشفى ميدكلينيك سيتي سنتر',
                'en' => 'Medcare City Centre Hospital',
            ],
            [
                'ar' => 'مستشفى النور',
                'en' => 'Al Noor Hospital',
            ],
        ];

        foreach ($hospitals as $hospital) {
            \App\Models\Hospital::create(['name' => $hospital]);
        }
    }
}
