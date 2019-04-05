<?php

namespace Nulisec\JetsoftShopconnector\Http\Middleware;

use Nulisec\JetsoftShopconnector\JetsoftShopconnector;

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
        return resolve(JetsoftShopconnector::class)->authorize($request) ? $next($request) : abort(403);
    }
}
