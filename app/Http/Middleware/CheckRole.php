<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckRole
{
    /**
     * Handle an incoming request, and check if user has needed $role.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            if ($user->hasRole($role)) {
                return $next($request);

            } else {
                return response()->json(['error' => 'no_access'], 405);
            }

        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'token_expired'], 401);

        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'token_invalid'], 401);

        } catch (JWTException $e) {
            return response()->json(['error' => 'no_token'], 401);

        }
    }
}

/*
 *
 *
 *
 * */