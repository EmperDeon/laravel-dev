<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['name', 'desc_s', 'desc'];

    public function theatre ()
    {
        return $this->belongsTo('App\Theatre', 'theatre_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
