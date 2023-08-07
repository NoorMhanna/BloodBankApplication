<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        $this->app->bind(
            'App\Http\Interfaces\UserInterface',
            'App\Http\Repositories\UsersRepository'
        );
    }
}
