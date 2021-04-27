<?php

namespace App\Providers;

use App\Services\PDF\Contracts\PdfServiceInterface;
use App\Services\PDF\PdfService;
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
        //

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(PdfServiceInterface::class,PdfService::class);
        //
    }
}
