<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $families = [
            ['ar' => 'الظاهري', 'en' => 'Al-Dhahiri'],
            ['ar' => 'البلوشي', 'en' => 'Al-Balushi'],
            ['ar' => 'البدوي', 'en' => 'Al-Bedawi'],
            ['ar' => 'الحمادي', 'en' => 'Al-Hammadi'],
            ['ar' => 'الخميري', 'en' => 'Al-Khamiri'],
            ['ar' => 'الخليفي', 'en' => 'Al-Khalifi'],
            ['ar' => 'الشحيمي', 'en' => 'Al-Shahimi'],
            ['ar' => 'الشنقيطي', 'en' => 'Al-Shanqeeti'],
        ];

        foreach ($families as $family) {
            \App\Models\Genealogy::create(['name' => $family]);
        }
    }
}
