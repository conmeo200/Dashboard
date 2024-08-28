<?php

namespace App\Providers;

use App\Repositories\Products\ProductsInterface;
use App\Repositories\Products\ProductsRepository;
use Illuminate\Support\ServiceProvider;

class ResponsiveProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductsInterface::class, ProductsRepository::class);
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
