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
        $this->call(CitiesSeeder::class);
        $this->call(NationalitySeeder::class);
        // $this->call(FamilySeeder::class);
        $this->call(HospitalsSeeder::class);
        $this->call(CemeteriesSeeder::class);
    }
}
