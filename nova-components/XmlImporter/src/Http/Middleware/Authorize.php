<?php

namespace Nulisec\XmlImporter\Http\Middleware;

use Nulisec\XmlImporter\XmlImporter;

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
        return resolve(XmlImporter::class)->authorize($request) ? $next($request) : abort(403);
    }
}
