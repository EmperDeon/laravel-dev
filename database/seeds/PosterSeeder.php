<?php

use App\Poster;
use Carbon\Carbon;
use App\Interfaces\TS;

class PosterSeeder extends TS
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $d = Carbon::today()->addHours(19);

        Poster::create(['hall_id' => TS::id(1), 't_perf_id' => TS::id(1), 'date' => $d]);
        Poster::create(['hall_id' => TS::id(2), 't_perf_id' => TS::id(2), 'date' => $d]);
        Poster::create(['hall_id' => TS::id(5), 't_perf_id' => TS::id(5), 'date' => $d]);

        $d->addDays(5);
        Poster::create(['hall_id' => TS::id(2), 't_perf_id' => TS::id(2), 'date' => $d]);
        Poster::create(['hall_id' => TS::id(1), 't_perf_id' => TS::id(3), 'date' => $d->addHours(1)]);
        Poster::create(['hall_id' => TS::id(3), 't_perf_id' => TS::id(2), 'date' => $d]);
        Poster::create(['hall_id' => TS::id(4), 't_perf_id' => TS::id(5), 'date' => $d->addHours(1)]);

        $d->subHours(2)->addMonth(1);
        Poster::create(['hall_id' => TS::id(3), 't_perf_id' => TS::id(1), 'date' => $d]);
        Poster::create(['hall_id' => TS::id(4), 't_perf_id' => TS::id(4), 'date' => $d]);
        Poster::create(['hall_id' => TS::id(5), 't_perf_id' => TS::id(5), 'date' => $d]);
        Poster::create(['hall_id' => TS::id(6), 't_perf_id' => TS::id(6), 'date' => $d]);

        $d->addMonth(1);
        Poster::create(['hall_id' => TS::id(3), 't_perf_id' => TS::id(1), 'date' => $d]);
        Poster::create(['hall_id' => TS::id(4), 't_perf_id' => TS::id(4), 'date' => $d]);
        Poster::create(['hall_id' => TS::id(5), 't_perf_id' => TS::id(5), 'date' => $d]);
        Poster::create(['hall_id' => TS::id(6), 't_perf_id' => TS::id(6), 'date' => $d]);
    }
}
