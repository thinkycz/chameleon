<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class UserOwnsProfile
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
        if ($request->route('user') instanceof User) {
            $profile = $request->route('user');
        } else {
            $profile = User::findOrFail($request->route('user'));
        }

        if (!$profile->is(User::getAuthenticatedUser())) {
            return abort(403, 'Access denied');
        }

        return $next($request);
    }
}
