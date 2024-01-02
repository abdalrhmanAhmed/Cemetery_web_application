<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Country;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrays = [
            // ['name_en' => 'Bahrain', 'name_ar' => 'البحرين'],
            // ['name_en' => 'Egypt', 'name_ar' => 'مصر'],
            // ['name_en' => 'Iran', 'name_ar' => 'إيران'],
            // ['name_en' => 'Iraq', 'name_ar' => 'العراق'],
            // ['name_en' => 'Israel', 'name_ar' => 'إسرائيل'],
            // ['name_en' => 'Jordan', 'name_ar' => 'الأردن'],
            // ['name_en' => 'Kuwait', 'name_ar' => 'الكويت'],
            // ['name_en' => 'Lebanon', 'name_ar' => 'لبنان'],
            // ['name_en' => 'Oman', 'name_ar' => 'عمان'],
            // ['name_en' => 'Palestine', 'name_ar' => 'فلسطين'],
            // ['name_en' => 'Qatar', 'name_ar' => 'قطر'],
            // ['name_en' => 'Saudi Arabia', 'name_ar' => 'المملكة العربية السعودية'],
            // ['name_en' => 'Syria', 'name_ar' => 'سوريا'],
            // ['name_en' => 'Turkey', 'name_ar' => 'تركيا'],
            ['en' => 'United Arab Emirates', 'ar' => 'الإمارات العربية المتحدة'],
            // ['name_en' => 'Yemen', 'name_ar' => 'اليمن'],
        ];
        foreach ($arrays as $array) {
            $country = new Country();
            $country->name = $array;
            $country->save();
        }
    }
}
