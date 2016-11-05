<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class P_Type extends Model
{
    protected $fillable = ['name'];

    public function performances () {
        return $this->hasMany('App\Performance', 'type_id');
    }
}
