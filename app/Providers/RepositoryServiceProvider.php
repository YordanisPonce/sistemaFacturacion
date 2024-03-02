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

		$this->app->bind(
			\App\Interfaces\EloquentClientRepositoryInterface::class,
			\App\Repositories\EloquentClientRepository::class
		);

		$this->app->bind(
			\App\Interfaces\EloquentBusinessRepositoryInterface::class,
			\App\Repositories\EloquentBusinessRepository::class
		);

		$this->app->bind(
			\App\Interfaces\EloquentEnterpriseRepositoryInterface::class,
			\App\Repositories\EloquentEnterpriseRepository::class
		);

		$this->app->bind(
			\App\Interfaces\EloquentTaxRepositoryInterface::class,
			\App\Repositories\EloquentTaxRepository::class
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
