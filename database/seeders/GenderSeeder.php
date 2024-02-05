<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  \App\Models\User::factory(10)->create();
        DB::table('genders')->insert([
            'id' => 1,
            'name' => 'Masculino',
            'is_active' => true,
        ]);
        DB::table('genders')->insert([
            'id' => 2,
            'name' => 'Femenino',
            'is_active' => true,
        ]);
        DB::table('genders')->insert([
            'id' => 3,
            'name' => 'Otro',
            'is_active' => true,
        ]);
    }
}
