<?php

namespace App\Http\Middleware;

use Closure;

class AccessAdministrationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        if ($user && $user->hasRoleWithPermission('access-administration')) {
            return $next($request);
        }

        abort(403, 'Access denied');
    }
}
