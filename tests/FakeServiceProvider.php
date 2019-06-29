<?php

namespace Bmatovu\MtnMomo\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Exception\RequestException;
use Bmatovu\MtnMomo\Console\RegisterIdCommand;

class FakeServiceProvider extends ServiceProvider
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
                // BootstrapCommand::class,
                RegisterIdCommand::class,
                // ValidateIdCommand::class,
                // RequestSecretCommand::class,
            ]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind('GuzzleHttp\ClientInterface', function ($app) {
            // Create a mock and queue two responses.
            $mockHandler = new MockHandler([
                new Response(201, [], null),
                new Response(401, [], json_encode(['error' => 'Unauthorized access.'])),
                new RequestException('Error Communicating with Server', new Request('GET', 'last')),
            ]);

            $historyContainer = [];
            $historyMiddleware = Middleware::history($historyContainer);

            $handlerStack = HandlerStack::create($mockHandler);

            // Add the history middleware to the handler stack.
            $handlerStack->push($historyMiddleware);

            return new Client([
                'handler' => $handlerStack,
                'progress' => function () {
                    echo '. ';
                },
                'base_uri' => 'https://api.fake.com/',
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Ocp-Apim-Subscription-Key' => 'fake_pdt_key',
                ],
                'json' => [
                    'body',
                ],
            ]);
        });
    }
}
