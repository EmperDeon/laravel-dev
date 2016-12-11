<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable = ['name', 'theatre_id', 'bio', 'img'];

    public function theatre()
    {
        return $this->belongsTo('App\Theatre', 'theatre_id', 'id');
    }
}
