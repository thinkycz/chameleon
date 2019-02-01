<?php

namespace App\Http\Middleware;

use App;
use App\Enums\Locale;
use App\Models\Currency;
use App\Models\User;
use Carbon\Carbon;
use Closure;
use Session;

class SetLocaleMiddleware
{
    private $user;

    public function __construct()
    {
        $this->user = User::getAuthenticatedUser();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->setLanguage($request);
        $this->setCurrency($request);

        return $next($request);
    }

    private function setCurrency($request)
    {
        if ($requestedCurrency = $request->get('currency')) {
            $requestedCurrency = Currency::whereIsocode($requestedCurrency)->first();
        }

        $currency = $requestedCurrency ?: Session::get('currency') ?: optional($this->user)->currency ?: preferenceRepository()->getDefaultCurrency();

        if ($requestedCurrency && auth()->check()) {
            $this->user->currency()->associate($requestedCurrency);
            $this->user->save();
        }

        if ($currency) {
            Session::put('currency', $currency);
        }
    }

    private function setLanguage($request)
    {
        $requestedLang = $request->get('lang');

        $locale = $requestedLang ?: Session::get('lang') ?: optional($this->user)->locale ?: getAppLocale();

        if (!in_array($locale, Locale::codes())) {
            return $next($request);
        }

        if ($requestedLang && auth()->check()) {
            $this->user->update(['locale' => $requestedLang]);
        }

        if ($locale) {
            App::setLocale($locale);
            Carbon::setLocale($locale);
            Session::put('lang', $locale);
        }
    }
}
