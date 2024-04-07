<?php

namespace App\Providers;

use App\Document2;
use App\Support\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Document2::class, function () {
            return new Document2(
                Config::all(),
            );
        });
    }
}
