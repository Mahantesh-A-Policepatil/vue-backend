<?php

namespace App\Providers;

use App\Repositories\CrmUserRepository;
use App\Repositories\Contracts\CrmUserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            CrmUserRepositoryInterface::class,
            CrmUserRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
