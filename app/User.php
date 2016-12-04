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
        'login', 'phone', 'fio',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'hash', 'remember_token',
    ];

    public function perms() {
        return $this->belongsToMany('App\U_Perm', 'user__perms', 'user_id', 'perm_id');
    }

    /**
     * Check, are user has role $s
     *
     * @param $s
     * @return bool
     */
    public function hasPerm($s) {
        foreach($this->perms->all() as $v){
            if($v->perm == $s)
                return true;
        }

        return false;
    }


}
