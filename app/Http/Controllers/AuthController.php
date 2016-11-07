<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;


class AuthController extends Controller
{

    /**
     *
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout () {
        Auth::logout();

        return redirect('/');

    }

    /**
     * Get token for login/password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function auth (Request $request)
    {
        $credentials = $request->only('login', 'password');

        $user = User::where('login', $credentials['login'])->take(1)->get();

        if($user->count() == 0) // Check login
            return response()->json(['error' => 'invalid_credentials'], 401);

        $user = $user[0];

        if(! Hash::check($credentials['password'], $user->hash)) // Check password
            return response()->json(['error' => 'invalid_credentials'], 401);


        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::fromUser($user)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token', 'message' => $e->getMessage()], 500);

        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    /**
     * Refresh token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh (Request $request)
    {
        try {
            $newToken = JWTAuth::parseToken()->refresh();

        } catch (JWTException $e) {
            return response()->json(['error' => 'token_invalid', 'message' => $e->getMessage()], 401);
        }

        return response()->json(compact('newToken'));
    }


    /**
     * Validate token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check (Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            return response()->json([], 200);


        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'token_expired', 'message' => $e->getMessage()], 401);

        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'token_invalid', 'message' => $e->getMessage()], 401);

        } catch (JWTException $e) {
            return response()->json(['error' => 'no_token', 'message' => $e->getMessage()], 401);

        }
    }

    /**
     * Return all user roles
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function roles(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            $r = [];
            foreach($user->roles as $v)
                $r[] = $v->role;

            return response()->json(['roles' => $r], 200);

        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'token_expired'], 401);

        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'token_invalid'], 401);

        } catch (JWTException $e) {
            return response()->json(['error' => 'no_token'], 401);

        }
    }
}
