<?php

use App\T_Performance;
use App\Interfaces\TS;
use Illuminate\Support\Facades\DB;

class T_PerformanceSeeder extends TS
{

    /**
     * Adds specified random actors to Many-to-Many table
     *
     * @param $p
     * @param $a
     */
    private function add ($p, $a, $r) {
        for($i = 0 ; $i < 4 ; $i++)
            DB::table('perfs__actors')->insert(['t__perf_id' => TS::id($p), 'actor_id' => TS::id($a[$r[$i]])]);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        T_Performance::create(['theatre_id' => TS::id(1), 'perf_id' => TS::id(1), 'desc' => 'Длинное описание с <b>тегами</b>', 'desc_s' => 'Короткое описание']);
        T_Performance::create(['theatre_id' => TS::id(1), 'perf_id' => TS::id(2), 'desc' => 'Длинное описание с <b>тегами</b>', 'desc_s' => 'Короткое описание']);
        T_Performance::create(['theatre_id' => TS::id(1), 'perf_id' => TS::id(3), 'desc' => 'Длинное описание с <b>тегами</b>', 'desc_s' => 'Короткое описание']);

        T_Performance::create(['theatre_id' => TS::id(2), 'perf_id' => TS::id(2), 'desc' => 'Длинное описание с <b>тегами</b>', 'desc_s' => 'Короткое описание']);
        T_Performance::create(['theatre_id' => TS::id(2), 'perf_id' => TS::id(3), 'desc' => 'Длинное описание с <b>тегами</b>', 'desc_s' => 'Короткое описание']);
        T_Performance::create(['theatre_id' => TS::id(2), 'perf_id' => TS::id(4), 'desc' => 'Длинное описание с <b>тегами</b>', 'desc_s' => 'Короткое описание']);

        for ($i = 1 ; $i < 4 ; $i++)
            $this->add($i, [1, 2, 3, 4, 5], array_rand([1, 2, 3, 4, 5], 4));

        for ($i = 4 ; $i < 7 ; $i++)
            $this->add($i, [6, 7, 8, 9, 10], array_rand([6, 7, 8, 9, 10], 4));
    }
}
