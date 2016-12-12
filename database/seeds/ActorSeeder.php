<?php

use App\Actor;
use App\Interfaces\TS;

class ActorSeeder extends TS
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Actor::create(['name' => 'Оксана Валеева', 'theatre_id' => TS::id(1), 'bio' => 'Описание актера 1', 'img' => 'img/none.jpg']);
        Actor::create(['name' => 'Оксана Чичерина', 'theatre_id' => TS::id(1), 'bio' => 'Описание актера 2', 'img' => 'img/none.jpg']);
        Actor::create(['name' => 'Андрей Плаксаев', 'theatre_id' => TS::id(1), 'bio' => 'Описание актера 3', 'img' => 'img/none.jpg']);
        Actor::create(['name' => 'Альберт Ахунов', 'theatre_id' => TS::id(1), 'bio' => 'Описание актера 4', 'img' => 'img/none.jpg']);
        Actor::create(['name' => 'Вера Ромашова', 'theatre_id' => TS::id(1), 'bio' => 'Описание актера 5', 'img' => 'img/none.jpg']);

        Actor::create(['name' => 'Натаья Аринушкина', 'theatre_id' => TS::id(2), 'bio' => 'Описание актера 6', 'img' => 'img/none.jpg']);
        Actor::create(['name' => 'Андрей Нурмухаметов', 'theatre_id' => TS::id(2), 'bio' => 'Описание актера 7', 'img' => 'img/none.jpg']);
        Actor::create(['name' => 'Александр Кузнецов', 'theatre_id' => TS::id(2), 'bio' => 'Описание актера 8', 'img' => 'img/none.jpg']);
        Actor::create(['name' => 'Иван Шабанов', 'theatre_id' => TS::id(2), 'bio' => 'Описание актера 9', 'img' => 'img/none.jpg']);
        Actor::create(['name' => 'Ильгиз Хакимов', 'theatre_id' => TS::id(2), 'bio' => 'Описание актера 10', 'img' => 'img/none.jpg']);
    }
}
