<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //

		$this->app->bind(
			\App\Interfaces\EloquentUserRepositoryInterface::class,
			\App\Repositories\EloquentUserRepository::class
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
