<?php

namespace App\Providers;

use App\Jobs\Dispatcher as JobDispatcher;
use Illuminate\Bus\Dispatcher;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->extend(Dispatcher::class, function ($service, $app) {
            return new JobDispatcher($app, function ($connection = null) use ($app) {
                return $app['queue']->connection($connection);
            });
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
