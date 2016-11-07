<?php

use App\T_Performance;
use Illuminate\Database\Seeder;

class T_PerformanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        T_Performance::create(['theatre_id' => '1', 'perf_id' => '1', 'desc' => 'Длинное описание с <b>тегами</b>', 'desc_s' => 'Короткое описание', 'img' => 'none.png']);
        T_Performance::create(['theatre_id' => '1', 'perf_id' => '2', 'desc' => 'Длинное описание с <b>тегами</b>', 'desc_s' => 'Короткое описание', 'img' => 'none.png']);
        T_Performance::create(['theatre_id' => '1', 'perf_id' => '3', 'desc' => 'Длинное описание с <b>тегами</b>', 'desc_s' => 'Короткое описание', 'img' => 'none.png']);

        T_Performance::create(['theatre_id' => '2', 'perf_id' => '2', 'desc' => 'Длинное описание с <b>тегами</b>', 'desc_s' => 'Короткое описание', 'img' => 'none.png']);
        T_Performance::create(['theatre_id' => '2', 'perf_id' => '3', 'desc' => 'Длинное описание с <b>тегами</b>', 'desc_s' => 'Короткое описание', 'img' => 'none.png']);
        T_Performance::create(['theatre_id' => '2', 'perf_id' => '4', 'desc' => 'Длинное описание с <b>тегами</b>', 'desc_s' => 'Короткое описание', 'img' => 'none.png']);
    }
}
