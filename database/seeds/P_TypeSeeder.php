<?php

use App\P_Type;
use Illuminate\Database\Seeder;

class P_TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        P_Type::create(['name' => 'Опера']);
        P_Type::create(['name' => 'Балет']);
        P_Type::create(['name' => 'Оперетта']);
        P_Type::create(['name' => 'Музыкальная комедия']);
        P_Type::create(['name' => 'Спектакль для детей']);
    }
}
