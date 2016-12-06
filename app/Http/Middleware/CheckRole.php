<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Config;
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
     * @param  $perm
     * @return mixed
     */
    public function handle($request, Closure $next, $perm)
    {
        Config::set('auth.providers.users.model', User::class);
        try {
            $user = JWTAuth::parseToken()->authenticate();

            if ($user->hasPerm($perm)) {
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