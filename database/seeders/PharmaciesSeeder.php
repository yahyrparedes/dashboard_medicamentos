<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PharmaciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pharmacies')->insert([
            'id' => 1,
            'name' => 'Inkafarma',
            'is_active' => true,
        ]);
        DB::table('pharmacies')->insert([
            'id' => 2,
            'name' => 'Mifarma',
            'is_active' => true,
        ]);
    }
}
