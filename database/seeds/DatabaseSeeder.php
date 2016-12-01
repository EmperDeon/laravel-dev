<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TheatreSeeder::class);

        $this->call(UserSeeder::class);
        $this->call(U_RolesSeeder::class);

        $this->call(ActorSeeder::class);
        $this->call(P_TypeSeeder::class);
        $this->call(PerformanceSeeder::class);

        $this->call(HallSeeder::class);
        $this->call(T_PerformanceSeeder::class);

        $this->call(PosterSeeder::class);

        $this->call(ArticleSeeder::class);
    }
}
