<?php

namespace Database\Seeders;

use App\Utils\Constants;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => Constants::ROLE_ADMIN]);
        Role::create(['name' => Constants::ROLE_DOCTOR]);
        Role::create(['name' => Constants::ROLE_PATIENT]);

    }
}
