<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    protected $fillable = ['hall_id', 't_perf_id', 'date'];

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
