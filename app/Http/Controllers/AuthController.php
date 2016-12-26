<?php

namespace App\Http\Controllers;

use App\Interfaces\TController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends TController
{
    /**
     * [API]
     *
     * Get token for login/password
     *
     * @param \Illuminate\Http\Request $request
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
     * [API]
     *
     * Refresh token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $newToken = JWTAuth::parseToken()->refresh();

        return response()->json(['response' => $newToken]);
    }


    /**
     * [API]
     *
     * Validate token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function check()
    {
        $user = $this->getUser();
        if ($user)
            return response()->json(['response' => 'ok']);
        else
            return response()->json(['error' => 'token_invalid']);
    }

    /**
     * [API]
     *
     * Return all user permissions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function perms()
    {
        $user = $this->getUser();

        $r = [];
        foreach ($user->perms as $v)
            $r[] = $v->name;

        return response()->json(['response' => $r]);
    }
}
