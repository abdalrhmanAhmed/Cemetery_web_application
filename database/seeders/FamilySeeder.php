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
            ['name_ar' => 'الظاهري', 'name_en' => 'Al-Dhahiri'],
            ['name_ar' => 'البلوشي', 'name_en' => 'Al-Balushi'],
            ['name_ar' => 'البدوي', 'name_en' => 'Al-Bedawi'],
            ['name_ar' => 'الحمادي', 'name_en' => 'Al-Hammadi'],
            ['name_ar' => 'الخميري', 'name_en' => 'Al-Khamiri'],
            ['name_ar' => 'الخليفي', 'name_en' => 'Al-Khalifi'],
            ['name_ar' => 'الشحيمي', 'name_en' => 'Al-Shahimi'],
            ['name_ar' => 'الشنقيطي', 'name_en' => 'Al-Shanqeeti'],
        ];

        foreach ($families as $family) {
            \App\Models\Genealogy::create(['name' => $family]);
        }
    }
}
