<?php

namespace Nulisec\BulkImageUpload\Http\Middleware;

use Nulisec\BulkImageUpload\BulkImageUpload;

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
        return resolve(BulkImageUpload::class)->authorize($request) ? $next($request) : abort(403);
    }
}
