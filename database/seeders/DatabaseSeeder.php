<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(permissionTabelSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(GendorSeeder::class);
        $this->call(ReliginSeeder::class);
        $this->call(CountriesSeeder::class);
    }
}
