<?php

namespace Bmatovu\MtnMomo\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Handler\MockHandler;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Exception\RequestException;
use Bmatovu\MtnMomo\Console\RegisterIdCommand;
use Bmatovu\MtnMomo\Console\ValidateIdCommand;

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
                ValidateIdCommand::class,
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
        $this->app
            ->when(RegisterIdCommand::class)
            ->needs(ClientInterface::class)
            ->give(function($app) {
                $mockHandler = new MockHandler([
                    new Response(201, [], null),
                    new Response(401, [], json_encode(['error' => 'Unauthorized access.'])),
                    new RequestException('Error Communicating with Server', new Request('GET', 'last')),
                ]);

                return $this->mockClient($mockHandler);
            });

        $this->app
            ->when(ValidateIdCommand::class)
            ->needs(ClientInterface::class)
            ->give(function($app) {
                $mockHandler = new MockHandler([
                    new Response(200, [], json_encode([
                        'key' => 'value',
                    ])),
                    new Response(401, [], json_encode(['error' => 'Unauthorized access.'])),
                    new RequestException('Error Communicating with Server', new Request('GET', 'last')),
                ]);

                return $this->mockClient($mockHandler);
            });
    }

    /**
     * Create mock Guzzle HTTP client.
     *
     * @param  \GuzzleHttp\Handler\MockHandler $mockHandler
     *
     * @return \GuzzleHttp\Client
     */
    protected function mockClient(MockHandler $mockHandler)
    {
        $historyContainer = [];

        $historyMiddleware = Middleware::history($historyContainer);

        $handlerStack = HandlerStack::create($mockHandler);

        $handlerStack->push($historyMiddleware);

        return new Client([
            'handler' => $handlerStack,
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
    }
}
