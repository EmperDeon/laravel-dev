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
        Performance::create(['name' => 'Веселая Вдова', 'author' => 'Франц Легар', 'genre' => 'Оперетта']);
        Performance::create(['name' => 'Летучая Мышь', 'author' => 'Иоганн Штраус', 'genre' => 'Оперетта']);
        Performance::create(['name' => 'Голубой Дунай', 'author' => 'Иоганн Штраус', 'genre' => 'Балет']);
        Performance::create(['name' => 'Кодаса', 'author' => 'Загир Исмагилов', 'genre' => 'Музыкальная комедия']);
    }
}
