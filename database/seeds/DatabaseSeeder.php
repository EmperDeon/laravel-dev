<?php

use App\Interfaces\TS;

class DatabaseSeeder extends TS
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TheatreSeeder::class);

        // API
        $this->call(UserSeeder::class);
        $this->call(U_PerfsSeeder::class);

        // WEB-End
        $this->call(WebUserSeeder::class);

        $this->call(ActorSeeder::class);
        $this->call(P_TypeSeeder::class);
        $this->call(PerformanceSeeder::class);

        $this->call(HallSeeder::class);
        $this->call(T_PerformanceSeeder::class);

        $this->call(PosterSeeder::class);

        $this->call(ArticleSeeder::class);
    }
}
