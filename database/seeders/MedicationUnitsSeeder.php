<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicationUnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medication_units')->insert([
            'id' => 1,
            'name' => 'Ampolla',
            'is_active' => true,
        ]);
        DB::table('medication_units')->insert([
            'id' => 2,
            'name' => 'Tableta',
            'is_active' => true,
        ]);
        DB::table('medication_units')->insert([
            'id' => 3,
            'name' => 'Píldora',
            'is_active' => true,
        ]);
        DB::table('medication_units')->insert([
            'id' => 4,
            'name' => 'Jarabe',
            'is_active' => true,
        ]);
    }
}
