<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function ajaxOrRedirect($redirect, $success = true, $message = '', $error = 400)
    {
        if (request()->ajax() || request()->wantsJson()) {
            return response(compact('redirect', 'success', 'message'), $success ? 200 : $error);
        }

        return redirect($redirect);
    }

    protected function ajaxWithPayload($payload = null, $success = true, $message = '', $error = 400)
    {
        if (request()->ajax() || request()->wantsJson()) {
            return response(compact('payload', 'success', 'message'), $success ? 200 : $error);
        }

        return response();
    }

}
