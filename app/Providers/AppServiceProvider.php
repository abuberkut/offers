<?php

namespace App\Providers;

use App\Repositories\IOfferRepository;
use App\Repositories\IProductRepository;
use App\Repositories\ISellerRepository;
use App\Repositories\OfferRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SellerRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ISellerRepository::class, SellerRepository::class);
        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(IOfferRepository::class, OfferRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
