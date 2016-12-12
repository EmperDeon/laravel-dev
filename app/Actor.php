<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable = ['name', 'theatre_id', 'bio', 'img'];

    public function scopeUpdates($stamp)
    {
        return $this->where('updatet_at', '>', $stamp)->get();
    }
}
