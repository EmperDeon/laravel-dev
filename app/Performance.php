<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $fillable = ['name', 'author', 'type_id'];

    public function type () {
        return $this->belongsTo('App\P_Type');
    }

    public function t_perfs () {
        return $this->hasMany('App\T_Performance', 'perf_id');
    }
}
