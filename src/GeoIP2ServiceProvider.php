<?php

namespace Chintanlin\GeoIP2;

use Illuminate\Support\ServiceProvider;

class GeoIP2ServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('geoip2', function ($app) {
            if (file_exists(storage_path('app/GeoLite2-City.mmdb'))) {
                return new GeoIP2(storage_path('app/GeoLite2-City.mmdb'));
            } else {
                return new GeoIP2(__DIR__ . '/../tests/GeoIP2-City-Test.mmdb');
            }
        });

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\Update::class,
            ]);
        }
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
