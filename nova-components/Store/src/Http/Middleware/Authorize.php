<?php

namespace Nulisec\Store\Http\Middleware;

use Nulisec\Store\Store;

class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        return resolve(Store::class)->authorize($request) ? $next($request) : abort(403);
    }
}
