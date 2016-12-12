<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['text', 't_perf_id'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function t_perf()
    {
        return $this->belongsTo('App\T_Performance', 't_perf_id', 'id');
    }
}
