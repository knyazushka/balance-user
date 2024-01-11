<?php

namespace App\Providers;

use App\Contracts\BalanceRepositoryContract;
use App\Contracts\UserRepositoryContract;
use App\Repositories\BalanceRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(BalanceRepositoryContract::class, BalanceRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
