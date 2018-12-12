<?php

namespace App\Providers;

use App\Models\User;
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
        'App\Model' => 'App\Policies\ModelPolicy',
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
