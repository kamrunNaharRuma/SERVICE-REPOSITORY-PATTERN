<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Services\CategoryServiceInterface',
            'App\Services\CategoryServiceImplementation'
        );
        $this->app->bind(
            'App\Repositories\CategoryRepositoryInterface',
            'App\Repositories\CategoryRepositoryImplementation'
        );
        $this->app->bind(
            'App\Services\ProductServiceInterface',
            'App\Services\ProductServiceImplementation'
        );
        $this->app->bind(
            'App\Repositories\ProductRepositoryInterface',
            'App\Repositories\ProductRepositoryImplementation'
        );
        $this->app->bind(
            'App\Services\ProductSizeServiceInterface',
            'App\Services\ProductSizeServiceImplementation'
        );
        $this->app->bind(
            'App\Repositories\ProductSizeRepositoryInterface',
            'App\Repositories\ProductSizeRepositoryImplementation'
        );
        $this->app->bind(
            'App\Services\ProductColorServiceInterface',
            'App\Services\ProductColorServiceImplementation'
        );
        $this->app->bind(
            'App\Repositories\ProductColorRepositoryInterface',
            'App\Repositories\ProductColorRepositoryImplementation'
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
