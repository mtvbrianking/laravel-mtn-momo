<?php

namespace Bmatovu\MtnMomo;

use Illuminate\Support\ServiceProvider;

class MtnMomoServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/mtn-momo.php' => base_path('config/mtn-momo.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
         $this->mergeConfigFrom(__DIR__.'/../config/mtn-momo.php', 'mtn-momo');
    }

}
