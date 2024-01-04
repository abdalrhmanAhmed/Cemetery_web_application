<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nationalities = [
            ['name_ar' => 'الإمارات العربية المتحدة', 'name_en' => 'United Arab Emirates'],
            ['name_ar' => 'الهند', 'name_en' => 'India'],
            ['name_ar' => 'بنغلاديش', 'name_en' => 'Bangladesh'],
            ['name_ar' => 'التاميلية', 'name_en' => 'Tamil'],
            ['name_ar' => 'المالايالامية', 'name_en' => 'Malayalam'],
            ['name_ar' => 'الكانادا', 'name_en' => 'Kannada'],
            ['name_ar' => 'المهاراتية', 'name_en' => 'Marathi'],
            ['name_ar' => 'الأردية', 'name_en' => 'Urdu'],
            ['name_ar' => 'البنجابية', 'name_en' => 'Punjabi'],
            ['name_ar' => 'الفارسية', 'name_en' => 'Persian'],
            ['name_ar' => 'التركية', 'name_en' => 'Turkish'],
            ['name_ar' => 'العربية الفصحى', 'name_en' => 'Modern Standard Arabic'],
            ['name_ar' => 'الإنجليزية الأمريكية', 'name_en' => 'American English'],
            ['name_ar' => 'الإنجليزية البريطانية', 'name_en' => 'British English'],
            ['name_ar' => 'الفرنسية', 'name_en' => 'French'],
            ['name_ar' => 'الإسبانية', 'name_en' => 'Spanish'],
            ['name_ar' => 'البرتغالية', 'name_en' => 'Portuguese'],
            ['name_ar' => 'الألمانية', 'name_en' => 'German'],
            ['name_ar' => 'الإيطالية', 'name_en' => 'Italian'],
            ['name_ar' => 'الروسية', 'name_en' => 'Russian'],
            ['name_ar' => 'الصينية', 'name_en' => 'Chinese'],
            ['name_ar' => 'اليابانية', 'name_en' => 'Japanese'],
            ['name_ar' => 'الكورية', 'name_en' => 'Korean'],
            ['name_ar' => 'التايلاندية', 'name_en' => 'Thai'],
            ['name_ar' => 'الإندونيسية', 'name_en' => 'Indonesian'],
            ['name_ar' => 'الفيتنامية', 'name_en' => 'Vietnamese'],
            ['name_ar' => 'الماليزية', 'name_en' => 'Malaysian'],
            ['name_ar' => 'الفلبينية', 'name_en' => 'Filipino']
        ];

        foreach ($nationalities as $nationality) {
            \App\Models\Nationality::create(['name' => $nationality]);
        }
    }
}
