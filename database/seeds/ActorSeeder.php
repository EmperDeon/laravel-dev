<?php

use App\Actor;
use Illuminate\Database\Seeder;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Actor::create(['name' => 'Оксана Валеева', 'bio' => 'Описание актера 1', 'img' => 'img/none.jpg']);
        Actor::create(['name' => 'Оксана Чичерина', 'bio' => 'Описание актера 2', 'img' => 'img/none.jpg']);
        Actor::create(['name' => 'Андрей Плаксаев', 'bio' => 'Описание актера 3', 'img' => 'img/none.jpg']);
        Actor::create(['name' => 'Альберт Ахунов', 'bio' => 'Описание актера 4', 'img' => 'img/none.jpg']);
        Actor::create(['name' => 'Вера Ромашова', 'bio' => 'Описание актера 5', 'img' => 'img/none.jpg']);
        Actor::create(['name' => 'Натаья Аринушкина', 'bio' => 'Описание актера 6', 'img' => 'img/none.jpg']);
        Actor::create(['name' => 'Андрей Нурмухаметов', 'bio' => 'Описание актера 7', 'img' => 'img/none.jpg']);
        Actor::create(['name' => 'Александр Кузнецов', 'bio' => 'Описание актера 8', 'img' => 'img/none.jpg']);
        Actor::create(['name' => 'Иван Шабанов', 'bio' => 'Описание актера 9', 'img' => 'img/none.jpg']);
        Actor::create(['name' => 'Ильгиз Хакимов', 'bio' => 'Описание актера 10', 'img' => 'img/none.jpg']);
    }
}
