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
        $this->app->bind(
            'App\Services\ProductCategoryServiceInterface',
            'App\Services\ProductCategoryServiceImplementation'
        );
        $this->app->bind(
            'App\Repositories\ProductCategoryRepositoryInterface',
            'App\Repositories\ProductCategoryRepositoryImplementation'
        );
        $this->app->bind(
            'App\Services\ProductImageServiceInterface',
            'App\Services\ProductImageServiceImplementation'
        );
        $this->app->bind(
            'App\Repositories\ProductImageRepositoryInterface',
            'App\Repositories\ProductImageRepositoryImplementation'
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
