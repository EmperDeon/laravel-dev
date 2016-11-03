<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [];

    public function t_perf () {
        return $this->belongsTo('App\T_Performance', 't_perf_id', 'id');
    }
}
