<?php

/**
 * Created by PhpStorm.
 * User: ilya
 * Date: 12/6/2016
 * Time: 4:44 PM
 */

namespace App\Interfaces;

use Illuminate\Database\Seeder;

abstract class TS extends Seeder
{
    static public function id($i) {
        if (env('APP_DEBUG', false) == false)
            return ($i - 1) * 10 + 4;
        else
            return $i;
    }
}