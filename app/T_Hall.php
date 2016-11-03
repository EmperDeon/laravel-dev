<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class T_Hall extends Model
{
    protected $fillable = ['theatre_id', 'name', 'json'];

    public function theatre() {
        return $this->belongsTo('App\Theatre');
    }

    public function posters () {
        return $this->hasMany('App\Poster', 'hall_id', 'id');
    }
}
