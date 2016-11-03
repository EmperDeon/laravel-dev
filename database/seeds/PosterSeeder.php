<?php

use App\Poster;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PosterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $d = Carbon::today()->addHours(19);

        Poster::create(['hall_id' => 1, 't_perf_id' => 1, 'date' => $d]);
        Poster::create(['hall_id' => 2, 't_perf_id' => 2, 'date' => $d]);
        Poster::create(['hall_id' => 5, 't_perf_id' => 5, 'date' => $d]);

        $d->addDays(1);
        Poster::create(['hall_id' => 2, 't_perf_id' => 2, 'date' => $d]);
        Poster::create(['hall_id' => 1, 't_perf_id' => 3, 'date' => $d]);
        Poster::create(['hall_id' => 3, 't_perf_id' => 2, 'date' => $d]);
        Poster::create(['hall_id' => 4, 't_perf_id' => 5, 'date' => $d]);

        $d->addDays(2);
        Poster::create(['hall_id' => 3, 't_perf_id' => 1, 'date' => $d]);
        Poster::create(['hall_id' => 4, 't_perf_id' => 4, 'date' => $d]);
        Poster::create(['hall_id' => 5, 't_perf_id' => 5, 'date' => $d]);
        Poster::create(['hall_id' => 6, 't_perf_id' => 6, 'date' => $d]);
    }
}
