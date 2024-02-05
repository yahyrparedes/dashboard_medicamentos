<?php

namespace Database\Seeders;

use App\Models\User;
use App\Utils\Constants;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'name' => 'Yahyr',
            'last_name' => 'Paredes',
            'email' => 'yahyrparedesarteaga@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Lima123456'),
            'gender_id' => 1,
            'document_type_id' => 1,
            'document' => '73884071',
            'birthday' => '1997-08-14',
            'phone' => '960163968',
            'created_at' => now(),
            'updated_at' => now()
        ])->assignRole(Constants::ROLE_ADMIN);

        User::create([
            'id' => 2,
            'name' => 'Shandy',
            'last_name' => 'Harris',
            'email' => 'shandy@gruposbn.pe',
            'email_verified_at' => now(),
            'password' => Hash::make('Lima123456'),
            'gender_id' => 2,
//            'document_type_id' => 2,
//            'document' => '22222222',
//            'birthday' => '1950-03-06',
//            'phone' => '995061504',
            'created_at' => now(),
            'updated_at' => now()
//        ])->assignRole(Constants::ROLE_ADMIN);
        ])->assignRole(Constants::ROLE_DOCTOR);

        User::create([
            'id' => 3,
            'name' => 'Demo',
            'last_name' => 'Demo',
            'email' => 'demo@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'gender_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
//        ])->assignRole(Constants::ROLE_ADMIN);
        ])->assignRole(Constants::ROLE_DOCTOR);
//
//        User::create([
//            'id' => 4,
//            'name' => 'Nora',
//            'last_name' => 'Luna',
//            'email' => 'nluna@calzadoatlas.pe',
//            'email_verified_at' => now(),
//            'password' => Hash::make('Lima123456'),
//            'gender_id' => 2,
//            'created_at' => now(),
//            'updated_at' => now()
//        ])->assignRole(Constants::ROLE_ADMIN);
//
//        User::create([
//            'id' => 5,
//            'name' => 'Arnold',
//            'last_name' => 'Canchanya',
//            'email' => 'acanchanya@calzadochosica.com',
//            'email_verified_at' => now(),
//            'password' => Hash::make('Lima123456'),
//            'gender_id' => 1,
//            'created_at' => now(),
//            'updated_at' => now()
//        ])->assignRole(Constants::ROLE_ADMIN);
    }
}
