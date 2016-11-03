<?php

use App\T_Hall;
use Illuminate\Database\Seeder;

class HallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        T_Hall::create(['theatre_id' => 1, 'name' => 'Hall name 1', 'json' => '{}']);
        T_Hall::create(['theatre_id' => 1, 'name' => 'Hall name 2', 'json' => '{}']);
        T_Hall::create(['theatre_id' => 1, 'name' => 'Hall name 3', 'json' => '{}']);


        T_Hall::create(['theatre_id' => 2, 'name' => 'Hall name 1', 'json' => '{}']);
        T_Hall::create(['theatre_id' => 2, 'name' => 'Hall name 2', 'json' => '{}']);
        T_Hall::create(['theatre_id' => 2, 'name' => 'Hall name 3', 'json' => '{}']);
        T_Hall::create(['theatre_id' => 2, 'name' => 'Hall name 4', 'json' => '{}']);
    }
}
