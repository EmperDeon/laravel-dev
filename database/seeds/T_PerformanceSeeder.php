<?php

use App\T_Performance;
use App\Interfaces\TS;

class T_PerformanceSeeder extends TS
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        T_Performance::create(['theatre_id' => TS::id(1), 'perf_id' => TS::id(1), 'desc' => 'Длинное описание с <b>тегами</b>', 'desc_s' => 'Короткое описание', 'img' => 'none.png']);
        T_Performance::create(['theatre_id' => TS::id(1), 'perf_id' => TS::id(2), 'desc' => 'Длинное описание с <b>тегами</b>', 'desc_s' => 'Короткое описание', 'img' => 'none.png']);
        T_Performance::create(['theatre_id' => TS::id(1), 'perf_id' => TS::id(3), 'desc' => 'Длинное описание с <b>тегами</b>', 'desc_s' => 'Короткое описание', 'img' => 'none.png']);

        T_Performance::create(['theatre_id' => TS::id(2), 'perf_id' => TS::id(2), 'desc' => 'Длинное описание с <b>тегами</b>', 'desc_s' => 'Короткое описание', 'img' => 'none.png']);
        T_Performance::create(['theatre_id' => TS::id(2), 'perf_id' => TS::id(3), 'desc' => 'Длинное описание с <b>тегами</b>', 'desc_s' => 'Короткое описание', 'img' => 'none.png']);
        T_Performance::create(['theatre_id' => TS::id(2), 'perf_id' => TS::id(4), 'desc' => 'Длинное описание с <b>тегами</b>', 'desc_s' => 'Короткое описание', 'img' => 'none.png']);
    }
}
