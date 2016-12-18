<?php

namespace App\Http\Controllers;

use App\Interfaces\TController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends TController
{
    /**
     * Get token for login/password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function auth(Request $request)
    {
        $credentials = $request->only('login', 'password');

        $user = User::where('login', $credentials['login'])->take(1)->get();

        if ($user->count() == 0) // Check login
            return response()->json(['error' => 'invalid_credentials'], 401);

        $user = $user[0];

        if (!Hash::check($credentials['password'], $user->password)) // Check password
            return response()->json(['error' => 'invalid_credentials'], 401);


        // attempt to verify the credentials and create a token for the user
        if (!$token = JWTAuth::fromUser($user)) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

        JWTAuth::setToken($token);

        // all good so return the token
        return response()->json(['response' => $token]);
    }

    /**
     * Refresh token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(Request $request)
    {
        $newToken = JWTAuth::parseToken()->refresh();

        return response()->json(['response' => $newToken]);
    }


    /**
     * Validate token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check(Request $request)
    {
        $user = $this->getUser();

        return response()->json(['response' => 'ok'], 200);
    }

    /**
     * Return all user permissions
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function perms(Request $request)
    {
        $user = $this->getUser();

        $r = [];
        foreach ($user->perms as $v)
            $r[] = $v->name;

        return response()->json(['response' => $r], 200);
    }
}
