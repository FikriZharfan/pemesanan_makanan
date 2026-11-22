<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Pemesanan;
use App\Observers\PemesananObserver;
use App\Models\Produk;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Pemesanan::observe(PemesananObserver::class);
    }
}
