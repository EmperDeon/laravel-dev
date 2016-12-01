<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    protected $fillable = ['hall_id', 't_perf_id', 'date'];

    public function scopeBy_type ($query, $type) {
        $perf = T_Performance::by_type($type)->get();

        $query->where('t_perf_id', $perf->count() > 0 ? $perf->take(1)[0]->id : -1);

            foreach($perf as $v)
                $query->orWhere('t_perf_id', $v->id);

        return $query;
    }

    public function scopeBy_theatre ($query, $type) {
        $perf = T_Performance::by_theatre($type)->get();

        $query->where('t_perf_id', $perf->count() > 0 ? $perf->take(1)[0]->id : -1);

        foreach($perf as $v)
            $query->orWhere('t_perf_id', $v->id);

        return $query;
    }

    public function scopeBy_month ($query, $type) {
        $perf = T_Performance::by_type($type)->get();

        $query->where('t_perf_id', $perf->count() > 0 ? $perf->take(1)[0]->id : -1);

        foreach($perf as $v)
            $query->orWhere('t_perf_id', $v->id);

        return $query;
    }

    public function hall () {
        return $this->belongsTo('App\T_Hall', 'hall_id', 'id');
    }

    public function t_perf () {
        return $this->belongsTo('App\T_Performance', 't_perf_id', 'id');
    }

    public function favorites () {
        return $this->hasMany('App\Favorite', 'poster_id');
    }

    public function bookings () {
        return $this->hasMany('App\Booking', 'poster_id');
    }
}
