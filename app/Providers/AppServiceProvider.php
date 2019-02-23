<?php

namespace App\Providers;

use App\Models\Setting;
use Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function () {
            $this->mail();
        });
    }

    protected function mail()
    {
        if (config('mail.driver') != 'smtp') {
            return;
        }

        $config = Setting::loadConfiguration('mail_configuration');

        Config::set('mail', array_merge(config('mail'), [
            'host'       => $config['host'] ?? '',
            'port'       => $config['port'] ?? '',
            'encryption' => $config['encryption'] ?? '',
            'username'   => $config['username'] ?? '',
            'password'   => $config['password'] ?? '',
            'from'       => [
                'address' => $config['from_address'] ?? '',
                'name'    => $config['from_name'] ?? '',
            ],
        ])
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
