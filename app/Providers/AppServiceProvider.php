<?php

namespace App\Providers;

use App\Services\SSR\SidecarGateway;
use Illuminate\Support\ServiceProvider;
use Inertia\Ssr\Gateway;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->instance(Gateway::class, new SidecarGateway);
    }

    public function boot(): void
    {
        //
    }
}
