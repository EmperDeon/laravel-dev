<?php

use App\U_Role;
use Illuminate\Database\Seeder;

class U_RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u = 1;
        U_Role::create(['user_id' => $u, 'role' => 'create_theatre']);
        U_Role::create(['user_id' => $u, 'role' => 'edit_theatre']);


        $u = 2;
        U_Role::create(['user_id' => $u, 'role' => 'edit_theatre']);


        $u = 3;
//        U_Role::create(['user_id' => $u, 'role' => 'edit_theatre']);
//
//
        $u = 4;
//        U_Role::create(['user_id' => $u, 'role' => 'edit_theatre']);
    }
}
