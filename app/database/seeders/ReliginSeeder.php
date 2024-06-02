<?php

namespace Database\Seeders;

use App\Models\Religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReliginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Religion::create([
            'name' => ['ar' => 'مسلم', 'en' => 'Muslim']
        ]);
        Religion::create([
            'name' => ['ar' => 'مسيحي', 'en' => 'Christian']
        ]);
    }
}
