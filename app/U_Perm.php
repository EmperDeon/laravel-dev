<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class U_Perm extends Model
{
    protected $fillable = ['perm'];

    public function user() // TODO: Redo to Many-to-Many
    {
        return $this->belongsTo('App\User');
    }
}
