<?php

namespace Nulisec\GoogleSheetsImporter\Http\Middleware;

use Nulisec\GoogleSheetsImporter\GoogleSheetsImporter;

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
        return resolve(GoogleSheetsImporter::class)->authorize($request) ? $next($request) : abort(403);
    }
}
