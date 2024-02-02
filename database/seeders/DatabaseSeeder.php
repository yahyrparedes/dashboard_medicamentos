<?php

namespace Database\Seeders;

use App\Models\User;
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
        $this->call(RoleSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(DocumentTypeSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MedicationTypeSeeder::class);
        $this->call(MedicationUnitsSeeder::class);
        $this->call(MedicationSeeder::class);
        $this->call(PharmaciesSeeder::class);
    }
}
