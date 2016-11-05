<?php

use App\Performance;
use Illuminate\Database\Seeder;

class PerformanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Performance::create(['name' => 'Веселая Вдова', 'author' => 'Франц Легар', 'type_id' => '3']);
        Performance::create(['name' => 'Летучая Мышь', 'author' => 'Иоганн Штраус', 'type_id' => '3']);
        Performance::create(['name' => 'Голубой Дунай', 'author' => 'Иоганн Штраус', 'type_id' => '2']);
        Performance::create(['name' => 'Кодаса', 'author' => 'Загир Исмагилов', 'type_id' => '4']);
    }
}
