<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Vendor;
use App\Models\Product;
use App\Observers\BannerObserver;
use App\Observers\VendorObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Banner::observe(BannerObserver::class);
        Vendor::observe(VendorObserver::class);
        Product::observe(ProductObserver::class);
    }
}
