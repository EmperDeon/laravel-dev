<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theatre extends Model
{
    protected $fillable = ['name', 'desc', 'img', 'address', 'tel_num'];

    public function halls()
    {
        return $this->hasMany('App\T_Hall', 'theatre_id', 'id');
    }

    public function performances()
    {
        return $this->hasMany('App\T_Performance', 'theatre_id', 'id');
    }
}
