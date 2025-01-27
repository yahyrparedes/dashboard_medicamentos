<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medication_types')->insert([
            'id' => 1,
            'name' => 'Solución Oftálmica',
            'is_active' => true,
        ]);
        DB::table('medication_types')->insert([
            'id' => 2,
            'name' => 'Inyección',
            'is_active' => true,
        ]);
        DB::table('medication_types')->insert([
            'id' => 3,
            'name' => 'Pastilla',
            'is_active' => true,
        ]);
        DB::table('medication_types')->insert([
            'id' => 4,
            'name' => 'Gel',
            'is_active' => true,
        ]);
        DB::table('medication_types')->insert([
            'id' => 5,
            'name' => 'Unguento',
            'is_active' => true,
        ]);
    }
}
