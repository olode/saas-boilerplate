<?php

namespace SAAS\App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use SAAS\App\Tenant\Manager;
use SAAS\App\Tenant\Observers\TenantObserver;

class TenantServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Manager::class, function () {
            return new Manager();
        });

        $this->app->singleton(TenantObserver::class, function () {
            return new TenantObserver(app(Manager::class)->getTenant());
        });

        Request::macro('tenant', function () {
           return app(Manager::class)->getTenant();
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
