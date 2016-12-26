<?php

use App\Interfaces\TS;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends TS
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::statement('SET @@global.auto_increment_increment = 10');
//        DB::statement('SET @@global.auto_increment_offset = 4');
//        DB::statement('SET @@session.auto_increment_increment = 10');
//        DB::statement('SET @@session.auto_increment_offset = 4');

        $this->call(TheatreSeeder::class);

        $this->call(UserSeeder::class);
        $this->call(U_PermsSeeder::class);

//        $this->call(ActorSeeder::class);
        $this->call(P_TypeSeeder::class);
        $this->call(PerformanceSeeder::class);

        $this->call(HallSeeder::class);
        $this->call(T_PerformanceSeeder::class);

        $this->call(PosterSeeder::class);

        $this->call(ArticleSeeder::class);
    }
}
