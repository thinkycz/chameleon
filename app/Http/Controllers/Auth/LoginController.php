<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->accountDisabled($request)) {
            return $this->sendNotActiveResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function authenticated(Request $request, $user)
    {
        event(new Authenticated($this->guard(), $user));

        App::setLocale($user->locale);
        Carbon::setLocale($user->locale);
        Session::put('lang', $user->locale);

        snackbar()->success(trans('auth.welcome_back'));
    }

    protected function accountDisabled(Request $request)
    {
        if ($user = User::where($this->username(), $request->get($this->username()))->first()) {
            return $this->guard()->validate($this->credentials($request)) ? !$user->is_active : false;
        }

        return false;
    }

    protected function sendNotActiveResponse(Request $request)
    {
        $errors = (new MessageBag());
        $errors->add('', trans('auth.activation_error'));

        return redirect()->back()->withErrors($errors)->withInput($request->all());
    }
}
