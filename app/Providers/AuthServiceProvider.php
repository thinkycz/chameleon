<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Preference;
use App\Models\Setting;
use App\Models\User;
use App\Policies\OrderPolicy;
use App\Policies\PreferencePolicy;
use App\Policies\SettingPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Silvanite\Brandenburg\Traits\ValidatesPermissions;

class AuthServiceProvider extends ServiceProvider
{
    use ValidatesPermissions;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Order::class      => OrderPolicy::class,
        Preference::class => PreferencePolicy::class,
        Setting::class    => SettingPolicy::class
    ];

    protected $permissions = [

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        collect($this->permissions)->each(function ($permission) {
            Gate::define($permission, function (User $user) use ($permission) {
                return $this->nobodyHasAccess($permission) ? true : $user->hasRoleWithPermission($permission);
            });
        });

        $this->registerPolicies();

        Passport::routes();
    }
}
