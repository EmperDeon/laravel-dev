<?php

namespace App\Http\Middleware;

use App\Interfaces\TController;
use Closure;

class CheckRole
{
    /**
     * Handle an incoming request, and check if user has needed $perm.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string $perm
     * @return mixed
     */
    public function handle($request, Closure $next, string $perm)
    {
        $user = TController::getUser();

        if ($user->hasPerm($perm)) {
            return $next($request);

        } else {
            return response()->json(['error' => 'no_access'], 405);
        }
    }
}
