<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('document_types')->insert([
            'name' => 'DNI',
            'is_active' => true,
        ]);
        DB::table('document_types')->insert([
            'name' => 'Carnet de Extranjería',
            'is_active' => true,
        ]);
        DB::table('document_types')->insert([
            'name' => 'Pasaporte',
            'is_active' => true,
        ]);
    }
}
