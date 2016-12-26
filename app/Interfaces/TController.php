<?php

namespace App\Interfaces;

use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\Facades\JWTAuth;

class TController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Get \App\User from token
     *
     * @return \App\User
     */
    static public function getUser()
    {
        Config::set('auth.providers.users.model', User::class);

        return JWTAuth::parseToken()->authenticate();
    }

    /**
     * Get array of existing values from request
     *
     * @param \Illuminate\Http\Request $request
     * @param array $n
     * @return array
     */
    public function getOnly(Request $request, array $n):array
    {
        $r = [];

        foreach ($n as $v)
            if ($request->has($v))
                $r[$v] = $request->get($v);

        return $r;
    }
}