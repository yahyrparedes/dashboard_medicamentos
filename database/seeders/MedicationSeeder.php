<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medications')->insert([
            'id' => 1,
            'name' => 'Namax',
            'medication_type_id' => 1,
            'is_active' => true,
        ]);
        DB::table('medications')->insert([
            'id' => 2,
            'name' => 'Glamax',
            'medication_type_id' => 1,
            'is_active' => true,
        ]);
        DB::table('medications')->insert([
            'id' => 3,
            'name' => 'Xenda',
            'medication_type_id' => 1,
            'is_active' => true,
        ]);
        DB::table('medications')->insert([
            'id' => 4,
            'name' => 'Hoprix',
            'medication_type_id' => 1,
            'is_active' => true,
        ]);
        DB::table('medications')->insert([
            'id' => 5,
            'name' => 'Otro medicamento',
            'medication_type_id' => 1,
            'is_active' => true,
        ]);
    }
}
