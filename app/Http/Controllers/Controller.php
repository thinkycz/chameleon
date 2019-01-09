<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function ajaxOrRedirect($redirect, $success = true, $message = '')
    {
        if (request()->ajax() || request()->wantsJson()) {
            return compact('redirect', 'success', 'message');
        }

        return redirect($redirect);
    }

    protected function ajaxWithPayload($payload, $success = true, $message = '')
    {
        if (request()->ajax() || request()->wantsJson()) {
            return compact('payload', 'success', 'message');
        }

        return response();
    }

}
