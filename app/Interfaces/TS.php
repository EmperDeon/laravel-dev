<?php

namespace App\Interfaces;

use Illuminate\Database\Seeder;

class TS extends Seeder
{
    /**
     * @param $i
     * @return int
     */
    static public function id($i)
    {
        if ($i == 0)
            return 0;

        return ($i - 1) * 10 + 4;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    }
}