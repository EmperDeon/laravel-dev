<?php

use App\U_Perm;
use App\Interfaces\TS;
use Illuminate\Support\Facades\DB;

class U_PermsSeeder extends TS
{
    /**
     * Short function to add permissions to user
     *
     */
    public function add($u, $a) {
        foreach($a as $v)
            DB::table('user__perms')->insert(['user_id' => $u, 'perm_id' => TS::id($v)]);
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        U_Perm::create(['name' => 'theatres']); // 1
        U_Perm::create(['name' => 'performances']);
        U_Perm::create(['name' => 'articles']);
        U_Perm::create(['name' => 'actors']);
        U_Perm::create(['name' => 'users']); // 5

        U_Perm::create(['name' => 'edit_theatre']); // 6
        U_Perm::create(['name' => 'edit_poster']);
        U_Perm::create(['name' => 'edit_perf']);
        U_Perm::create(['name' => 'edit_article']);
        U_Perm::create(['name' => 'edit_actors']);
        U_Perm::create(['name' => 'edit_user']); // 11

        U_Perm::create(['name' => 'create_theatre']); // 12
        U_Perm::create(['name' => 'create_poster']);
        U_Perm::create(['name' => 'create_perf']);
        U_Perm::create(['name' => 'create_article']);
        U_Perm::create(['name' => 'create_actors']);
        U_Perm::create(['name' => 'create_user']); //17

        $this->add( TS::id(1), [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17]); // Admin

        $this->add( TS::id(2), [1, 2, 3, 4, 5, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17]); // Theatre admin

        $this->add( TS::id(3), [1, 2, 4, 6, 7, 8, 9, 10, 13, 14, 15, 16]); // Theatre users
        $this->add( TS::id(4), [1, 3, 7, 8, 9, 10, 13, 14, 15, 16]);

    }
}
