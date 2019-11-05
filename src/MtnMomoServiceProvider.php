<?php
/**
 * MtnMomoServiceProvider.
 */

namespace Bmatovu\MtnMomo;

use Monolog\Logger;
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\MessageFormatter;
use Monolog\Handler\StreamHandler;
use Illuminate\Support\ServiceProvider;
use Bmatovu\MtnMomo\Console\BootstrapCommand;
use Bmatovu\MtnMomo\Console\RegisterIdCommand;
use Bmatovu\MtnMomo\Console\ValidateIdCommand;
use Bmatovu\MtnMomo\Console\RequestSecretCommand;

/**
 * Package service provider.
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
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/mtn-momo.php' => base_path('config/mtn-momo.php'),
            ], 'config');

            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

            $this->commands([
                BootstrapCommand::class,
                RegisterIdCommand::class,
                ValidateIdCommand::class,
                RequestSecretCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/mtn-momo.php', 'mtn-momo');

        $this->app->bind(ClientInterface::class, function () {
            return $this->commandClient();
        });
    }

    /**
     * Create command's concrete client.
     *
     * @throws \Exception
     *
     * @return \GuzzleHttp\ClientInterface
     */
    protected function commandClient()
    {
        $handlerStack = HandlerStack::create();

        if ($this->app['config']->get('app.debug')) {
            $handlerStack->push($this->getLogMiddleware());
        }

        $product = $this->app['config']->get('mtn-momo.product');

        $options = array_merge([
            'handler' => $handlerStack,
            'progress' => function () {
                echo '. ';
            },
            'base_uri' => $this->app['config']->get('mtn-momo.api.base_uri'),
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Ocp-Apim-Subscription-Key' => $this->app['config']->get("mtn-momo.products.{$product}.key"),
            ],
            'json' => [
                'body',
            ],
        ], $this->app['config']->get('mtn-momo.guzzle.options'));

        return new Client($options);
    }

    /**
     * Get log middleware.
     *
     * @throws \Exception
     *
     * @return callable GuzzleHttp Middleware
     */
    protected function getLogMiddleware()
    {
        $logger = $this->app['log']->getLogger();
        $streamHandler = new StreamHandler(storage_path('logs/mtn-momo.log'));
        $logger->pushHandler($streamHandler, Logger::DEBUG);
        $messageFormatter = new MessageFormatter(MessageFormatter::DEBUG);

        return Middleware::log($logger, $messageFormatter);
    }
}
