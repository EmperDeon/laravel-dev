<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['poster_id'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function poster()
    {
        return $this->belongsTo('App\Poster', 'poster_id', 'id');
    }
}
