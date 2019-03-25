<?php
/**
 * MtnMomoServiceProvider.php
 *
 * @package Bmatovu\MtnMomo
 */

namespace Bmatovu\MtnMomo;

use Illuminate\Support\ServiceProvider;
use Bmatovu\MtnMomo\Console\BootstrapCommand;
use Bmatovu\MtnMomo\Console\RegisterIdCommand;
use Bmatovu\MtnMomo\Console\ValidateIdCommand;
use Bmatovu\MtnMomo\Console\RequestSecretCommand;

/**
 * Class MtnMomoServiceProvider
 */
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

        if ($this->app->runningInConsole()) {
            $this->commands([
                BootstrapCommand::class,
                RegisterIdCommand::class,
                ValidateIdCommand::class,
                RequestSecretCommand::class,
            ]);
        }

        // if (! class_exists('CreateMtnMomoTokensTable')) {
        //     $this->publishes([
        //         __DIR__.'/../database/migrations/create_mtn_momo_tokens_table.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_mtn_momo_tokens_table.php'),
        //     ], 'migrations');
        // }

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/mtn-momo.php', 'mtn-momo');

        // https://laravel.com/docs/5.3/container#binding-interfaces-to-implementations

        // $this->app->bind(
        //     'Bmatovu\MtnMomo\Models\Repository\TokenRepositoryInterface',
        //     'Bmatovu\MtnMomo\Models\Repository\TokenRepository'
        // );
    }
}
