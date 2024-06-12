<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerPostPolicies();
        
    }

    public function registerPostPolicies(){

        Gate::define('only-admin-can-access', function($user){
            return $user->hasAccess(['overall-functions']);
        });

        Gate::define('only-cashier-can-access', function($user){
            return $user->hasAccess(['cashier-functions']);
        });

        Gate::define('only-admin-and-cashier-can-access', function($user){
            return $user->hasAccess(['overall-functions']) or $user->hasAccess(['cashier-functions']);
        });


        Gate::define('only-customer-can-access', function($user){
            return $user->hasAccess(['customer-functions']);
        });

    }
}
