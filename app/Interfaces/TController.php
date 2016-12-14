<?php
/**
 * Created by PhpStorm.
 * User: ilya
 * Date: 12/13/2016
 * Time: 1:40 PM
 */

namespace App\Interfaces;

use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\Facades\JWTAuth;

class TController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Get \App\User from token
     *
     * @return mixed
     */
    static public function getUser()
    {
        Config::set('auth.providers.users.model', User::class);

        return JWTAuth::parseToken()->authenticate();
    }
}