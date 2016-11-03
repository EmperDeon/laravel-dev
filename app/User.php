<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'fio',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'hash', 'remember_token',
    ];

    public function roles() {
        return $this->hasMany('App\U_Role');
    }

    /**
     * Check, are user has role $s
     *
     * @param $s
     * @return bool
     */
    public function hasRole($s) {
        foreach($this->roles->all() as $v){
            if($v->role == $s)
                return true;
        }

        return false;
    }


}
