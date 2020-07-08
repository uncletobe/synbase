<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Http\Guards\XwsseGuard;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* register guard */
        Auth::extend("token", function () {
            $provider = new XwsseServiceProvider();
            return new XwsseGuard($provider);
        });

        /* register provider */
        Auth::provider("xwsse", function () {
            return new XwsseServiceProvider();
        });
    }
}
