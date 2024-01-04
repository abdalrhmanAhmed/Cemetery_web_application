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
            ['ar' => 'الإمارات العربية المتحدة', 'en' => 'United Arab Emirates'],
            ['ar' => 'الهند', 'en' => 'India'],
            ['ar' => 'بنغلاديش', 'en' => 'Bangladesh'],
            ['ar' => 'التاميلية', 'en' => 'Tamil'],
            ['ar' => 'المالايالامية', 'en' => 'Malayalam'],
            ['ar' => 'الكانادا', 'en' => 'Kannada'],
            ['ar' => 'المهاراتية', 'en' => 'Marathi'],
            ['ar' => 'الأردية', 'en' => 'Urdu'],
            ['ar' => 'البنجابية', 'en' => 'Punjabi'],
            ['ar' => 'الفارسية', 'en' => 'Persian'],
            ['ar' => 'التركية', 'en' => 'Turkish'],
            ['ar' => 'العربية الفصحى', 'en' => 'Modern Standard Arabic'],
            ['ar' => 'الإنجليزية الأمريكية', 'en' => 'American English'],
            ['ar' => 'الإنجليزية البريطانية', 'en' => 'British English'],
            ['ar' => 'الفرنسية', 'en' => 'French'],
            ['ar' => 'الإسبانية', 'en' => 'Spanish'],
            ['ar' => 'البرتغالية', 'en' => 'Portuguese'],
            ['ar' => 'الألمانية', 'en' => 'German'],
            ['ar' => 'الإيطالية', 'en' => 'Italian'],
            ['ar' => 'الروسية', 'en' => 'Russian'],
            ['ar' => 'الصينية', 'en' => 'Chinese'],
            ['ar' => 'اليابانية', 'en' => 'Japanese'],
            ['ar' => 'الكورية', 'en' => 'Korean'],
            ['ar' => 'التايلاندية', 'en' => 'Thai'],
            ['ar' => 'الإندونيسية', 'en' => 'Indonesian'],
            ['ar' => 'الفيتنامية', 'en' => 'Vietnamese'],
            ['ar' => 'الماليزية', 'en' => 'Malaysian'],
            ['ar' => 'الفلبينية', 'en' => 'Filipino']
        ];

        foreach ($nationalities as $nationality) {
            \App\Models\Nationality::create(['name' => $nationality]);
        }
    }
}
