<?php

namespace App\Http\Middleware;

use Closure;

class CategoryIsEnabled
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
        $category = $request->category;

        if ($category && !$category->enabled) {
            abort(404);
        }

        return $next($request);
    }
}
