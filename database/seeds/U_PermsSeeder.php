<?php

use App\U_Perm;
use App\Interfaces\TS;
use Illuminate\Support\Facades\DB;

class U_PermsSeeder extends TS
{
    /**
     * Short function to add permissions to user
     *
     * @param string $u - User id
     * @param array $a - User perms
     */
    private function add(string $u, array $a) {
        foreach($a as $v)
            DB::table('user__perms')->insert(['user_id' => $u, 'perm_id' => TS::id($v)]);
    }

    /**
     * Create 4 + count($a) perms
     *
     * @param string $n - Perm name
     * @param array $a - Additional perms
     */
    private function create(string $n, array $a = [])
    {
        $perms = ['s', '_create', '_edit', '_delete'];
        $perms = array_merge($perms, $a);

        foreach ($perms as $p)
            U_Perm::create(['name' => $n . $p]);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() // TODO: Tomorrow
    {
        $this->create('theatre'); // 1..4
        $this->create('user'); // 5..8

        $this->create('actor'); // 9..12
        $this->create('perf'); // 13..16
        $this->create('poster'); // 17..20

        $this->create('article'); // 21..24

        $this->create('t_perf'); // 25..28

        U_Perm::create(['name' => 'theatre_choose']);

        $this->add( TS::id(1), [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29]); // Admin
        $this->add( TS::id(2), [5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28]); // Theatre admin

        $this->add( TS::id(3), [13, 14, 15, 16, 17, 18, 19, 20, 21, 25, 26, 27, 28]); // Theatre users
        $this->add( TS::id(4), [21, 22, 23, 24]);

    }
}
