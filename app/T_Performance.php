<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class T_Performance extends Model
{
    protected $fillable = ['theatre_id', 'perf_id', 'desc', 'desc_s', 'img'];

    public function scopeBy_type($query, $id)
    {
        if ($id)
            return $query->whereHas('perf', function ($q) use ($id) {
                $q->where('type_id', $id);
            });

        return $query;
    }

    public function scopeBy_theatre($query, $id)
    {
        if ($id)
            return $query->where('theatre_id', $id);
        return $query;
    }

    public function scopeBy_name($query, $id)
    {
        if ($id)
            return $query->where('perf_id', $id);
        return $query;
    }

    public function theatre()
    {
        return $this->belongsTo('App\Theatre');
    }

    public function perf()
    {
        return $this->belongsTo('App\Performance');
    }

    public function posters()
    {
        return $this->hasMany('App\Poster', 't_perf_id');
    }

    public function actors()
    {
        return $this->belongsToMany('App\Actor', 'perfs__actors', 't__perf_id', 'actor_id');
    }
}
