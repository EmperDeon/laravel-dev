<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class T_Performance extends Model
{
    protected $fillable = ['theatre_id', 'perf_id', 'desc', 'desc_s', 'img'];

    public function theatre() {
        return $this->belongsTo('App\Theatre');
    }

    public function perf () {
        return $this->belongsTo('App\Performance');
    }

    public function posters () {
        return $this->hasMany('App\Poster', 't_perf_id');
    }

    public function comments () {
        return $this->hasMany('App\Comment', 't_perf_id');
    }
}
