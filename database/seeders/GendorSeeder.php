<?php

namespace Database\Seeders;

use App\Models\Gander;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Gander::create([
            'name' => ['ar' => 'ذكر', 'en' => 'Male']
        ]);
        Gander::create([
            'name' => ['ar' => 'أنثى', 'en' => 'Female']
        ]);
    }
}
