<?php

namespace App\Providers;

use App\Document2;
use App\Publisher;
use Illuminate\Filesystem\Filesystem;
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
                resolve(Filesystem::class),
                config('document2.doc_path')
            );
        });

        // $this->app->singleton(Publisher::class, function () {
        //     return new Publisher(
        //         resolve(Filesystem::class),
        //         config('document2.publish_path')
        //     );
        // });
    }
}
