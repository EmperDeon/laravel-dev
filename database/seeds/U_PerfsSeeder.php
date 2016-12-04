<?php

use App\U_Perm;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class U_PerfsSeeder extends Seeder
{
    /**
     *
     *
     */
    public function add($u, $a) {
        foreach($a as $v)
            DB::table('user__perms')->insert(['user_id' => $u, 'perm_id' => $v]);
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        U_Perm::create(['perm' => 'theatres']); // 1
        U_Perm::create(['perm' => 'performances']);
        U_Perm::create(['perm' => 'articles']);
        U_Perm::create(['perm' => 'actors']);
        U_Perm::create(['perm' => 'users']); // 5

        U_Perm::create(['perm' => 'edit_theatre']); // 6
        U_Perm::create(['perm' => 'edit_poster']);
        U_Perm::create(['perm' => 'edit_perf']);
        U_Perm::create(['perm' => 'edit_article']);
        U_Perm::create(['perm' => 'edit_actors']);
        U_Perm::create(['perm' => 'edit_user']); // 11

        U_Perm::create(['perm' => 'create_theatre']); // 12
        U_Perm::create(['perm' => 'create_poster']);
        U_Perm::create(['perm' => 'create_perf']);
        U_Perm::create(['perm' => 'create_article']);
        U_Perm::create(['perm' => 'create_actors']);
        U_Perm::create(['perm' => 'create_user']); //17

        $this->add(1, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17]); // Admin

        $this->add(2, [1, 2, 3, 4, 5, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17]); // Theatre admin

        $this->add(3, [1, 2, 4, 6, 7, 8, 9, 10, 13, 14, 15, 16]); // Theatre users
        $this->add(4, [1, 3, 7, 8, 9, 10, 13, 14, 15, 16]);

//        U_Perm::create(['user_id' => $u, 'role' => 'create_theatre']);
//        U_Perm::create(['user_id' => $u, 'role' => 'edit_theatre']);
//
//
//        $u = 2;
//        U_Perm::create(['user_id' => $u, 'role' => 'edit_theatre']);


        $u = 3;
//        U_Role::create(['user_id' => $u, 'role' => 'edit_theatre']);
//
//
        $u = 4;
//        U_Role::create(['user_id' => $u, 'role' => 'edit_theatre']);
    }
}
