<?php

namespace App\Providers;

use App\Repositories\notifications\notificationsRepositoryInterface;
use App\Repositories\notifications\notificationsRepository;

use App\Repositories\withdraw\withdrawRepositoryInterface;
use App\Repositories\withdraw\withdrawRepository;

use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {
//
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(withdrawRepositoryInterface::class, withdrawRepository::class);
        $this->app->bind(notificationsRepositoryInterface::class, notificationsRepository::class);
}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
