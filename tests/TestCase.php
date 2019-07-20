<?php
namespace Bmatovu\MtnMomo\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use Bmatovu\MtnMomo\MtnMomoServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setup();
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown()
    {
        parent::tearDown();

        \Mockery::close();
    }

    /**
     * Add package service provider
     *
     * @param $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            MtnMomoServiceProvider::class
        ];
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * Mock Guzzle client.
     *
     * @param  array $response
     *
     * @return \GuzzleHttp\Client
     */
    protected function mockGuzzleClient($response)
    {
        if(is_array($response)) {
            $responses = $response;
        } else {
            $responses[] = $response;
        }

        $mockHandler = new MockHandler($responses);

        $handlerStack = HandlerStack::create($mockHandler);

        return new Client([
            'base_uri' => 'http://api.example.com/mtn-momo/',
            'handler'  => $handlerStack,
            'headers'  => [
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }
}
