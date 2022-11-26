<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    private $models = [
        'User',
        'UserToken'
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
            $this->app->bind(
                \App\Repositories\Interfaces\UserTokenRepositoryInterface::class,
                \App\Repositories\Eloquents\UserTokenRepository::class
            );
            $this->app->bind(
                \App\Repositories\Interfaces\UserRepositoryInterface::class,
                \App\Repositories\Eloquents\UserRepository::class
            );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
