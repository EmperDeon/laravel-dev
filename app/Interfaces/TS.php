<?php

namespace App\Interfaces;

use Illuminate\Database\Seeder;

class TS extends Seeder
{
    static public function id($i) {
        if (env('APP_DEBUG', false) == false)
            return ($i - 1) * 10 + 4;
        else
            return $i;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {}
}