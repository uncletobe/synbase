<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Http\Guards\TokenGuard;

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
            $provider = new TokenServiceProvider();
            return new TokenGuard($provider);
        });

        /* register provider */
        Auth::provider("token", function () {
            return new TokenServiceProvider();
        });
    }
}
