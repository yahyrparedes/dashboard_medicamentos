<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert(['id' => 1, 'name' => 'Amazonas', 'ubigeo' => '01']);
        DB::table('departments')->insert(['id' => 2, 'name' => 'Áncash', 'ubigeo' => '02']);
        DB::table('departments')->insert(['id' => 3, 'name' => 'Apurímac', 'ubigeo' => '03']);
        DB::table('departments')->insert(['id' => 4, 'name' => 'Arequipa', 'ubigeo' => '04']);
        DB::table('departments')->insert(['id' => 5, 'name' => 'Ayacucho', 'ubigeo' => '05']);
        DB::table('departments')->insert(['id' => 6, 'name' => 'Cajamarca', 'ubigeo' => '06']);
        DB::table('departments')->insert(['id' => 7, 'name' => 'Callao', 'ubigeo' => '07']);
        DB::table('departments')->insert(['id' => 8, 'name' => 'Cusco', 'ubigeo' => '08']);
        DB::table('departments')->insert(['id' => 9, 'name' => 'Huancavelica', 'ubigeo' => '09']);
        DB::table('departments')->insert(['id' => 10, 'name' => 'Huánuco', 'ubigeo' => '10']);
        DB::table('departments')->insert(['id' => 11, 'name' => 'Ica', 'ubigeo' => '11']);
        DB::table('departments')->insert(['id' => 12, 'name' => 'Junín', 'ubigeo' => '12']);
        DB::table('departments')->insert(['id' => 13, 'name' => 'La Libertad', 'ubigeo' => '13']);
        DB::table('departments')->insert(['id' => 14, 'name' => 'Lambayeque', 'ubigeo' => '14']);
        DB::table('departments')->insert(['id' => 15, 'name' => 'Lima', 'ubigeo' => '15']);
        DB::table('departments')->insert(['id' => 16, 'name' => 'Loreto', 'ubigeo' => '16']);
        DB::table('departments')->insert(['id' => 17, 'name' => 'Madre de Dios', 'ubigeo' => '17']);
        DB::table('departments')->insert(['id' => 18, 'name' => 'Moquegua', 'ubigeo' => '18']);
        DB::table('departments')->insert(['id' => 19, 'name' => 'Pasco', 'ubigeo' => '19']);
        DB::table('departments')->insert(['id' => 20, 'name' => 'Piura', 'ubigeo' => '20']);
        DB::table('departments')->insert(['id' => 21, 'name' => 'Puno', 'ubigeo' => '21']);
        DB::table('departments')->insert(['id' => 22, 'name' => 'San Martín', 'ubigeo' => '22']);
        DB::table('departments')->insert(['id' => 23, 'name' => 'Tacna', 'ubigeo' => '23']);
        DB::table('departments')->insert(['id' => 24, 'name' => 'Tumbes', 'ubigeo' => '24']);
        DB::table('departments')->insert(['id' => 25, 'name' => 'Ucayali ', 'ubigeo' => '25']);
    }
}
