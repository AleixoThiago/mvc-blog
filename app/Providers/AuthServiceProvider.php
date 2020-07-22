<?php

namespace Blog\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Blog\Model' => 'Blog\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('eAdmin', function ($user) {
            return $user->admin == "S";
        });
        Gate::define('autor', function ($user) {
            return ($user->admin == "S" ? true : $user->autor == "S");
        });
    }
}
