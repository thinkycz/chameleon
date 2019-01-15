<?php

namespace App\Http\Middleware;

use Closure;

class BasketIsNotEmpty
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
        if (activeBasket()->hasOrderedItems()) {
            return $next($request);
        }

        abort(403);
    }
}
