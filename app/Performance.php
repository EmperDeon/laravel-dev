<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $fillable = ['name', 'author', 'genre'];

    public function t_perfs () {
        return $this->hasMany('App\T_Performance', 'perf_id');
    }
}
