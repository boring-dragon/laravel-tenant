<?php

namespace Jinas\LaravelTenant;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Jinas\LaravelTenant\Listeners\SetTenantIdInSession;
use Jinas\LaravelTenant\Listeners\ClearTenantIdFromSession;

class LaravelTenantServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        Event::listen(
            \Illuminate\Auth\Events\Login::class,
            SetTenantIdInSession::class
        );

        Event::listen(
            \Illuminate\Auth\Events\Logout::class,
            ClearTenantIdFromSession::class
        );

        $this->publishes([
            __DIR__ .'/../database/migrations/create_tenants_table.php',
            database_path('migrations/'.date('Y-m-d_His').'_create_tenants_table.php')
        ]);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
