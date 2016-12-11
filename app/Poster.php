<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Poster extends Model
{
    protected $fillable = ['hall_id', 't_perf_id', 'date'];

    public function scopeBy_month($query, $month)
    {
        if ($month)
            return $query->whereMonth('date', $month);
        return $query;
    }

    public function scopeBy_type($query, $type)
    {
        $perf = T_Performance::by_type($type)->get();

        $query->where('t_perf_id', $perf->count() > 0 ? $perf->take(1)[0]->id : -1);

        foreach ($perf as $v)
            $query->orWhere('t_perf_id', $v->id);

        return $query;
    }

    public function scopeBy_theatre($query, $id)
    {
        $perf = T_Performance::by_theatre($id)->get();

        $query->where('t_perf_id', $perf->count() > 0 ? $perf->take(1)[0]->id : -1);

        foreach ($perf as $v)
            $query->orWhere('t_perf_id', $v->id);

        return $query;
    }

    public function scopeBy_name($query, $id)
    {
        $perf = T_Performance::by_name($id)->get();

        $query->where('t_perf_id', $perf->count() > 0 ? $perf->take(1)[0]->id : -1);

        foreach ($perf as $v)
            $query->orWhere('t_perf_id', $v->id);

        return $query;
    }

    public function scopeBy_date($query, $day)
    {
        if ($day)
            return $query->whereRaw('DAYOFWEEK(date) = ?', [$day]);
        return $query;
    }


    /**
     * Get all possible poster times for 'Time' sort
     *
     * @return array
     */
    private function getTimeCont()
    {
        $r = [];
        $a = DB::select('select distinct DATE_FORMAT(date, \'%H:%i\') AS \'time\' FROM posters');

        foreach ($a as $v)
            $r[] = $v->time;

        return $r;
    }

    public function scopeBy_time($query, $time)
    {
        if ($time)
            return $query->whereRaw('DATE_FORMAT(date, \'%H:%i\') = ?', $this->getTimeCont()[$time - 1]);
        return $query;
    }

    public function scopeClosest($query, $count)
    {
        if ($count)
            return $query->where('date', '>', Carbon::today())->limit($count);
        else
            return $query;
    }

    public function scopeBy_performance($query, $id, $count)
    {
        if ($id) {
            $query->where('t_perf_id', $id);
            if ($count > 0)
                $query->limit($count);
        }

        return $query;
    }

    public function hall()
    {
        return $this->belongsTo('App\T_Hall', 'hall_id', 'id');
    }

    public function t_perf()
    {
        return $this->belongsTo('App\T_Performance', 't_perf_id', 'id');
    }
}
