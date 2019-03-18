<?php

namespace Bmatovu\MtnMomo\Test;

use Bmatovu\MtnMomo\MtnMomoServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        // Create .env in test env
        touch($this->app->environmentFilePath());
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        // Remove .env in test env
        unlink($this->app->environmentFilePath());

        parent::tearDown();
    }

    /**
     * Add package service provider.
     *
     * @param $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            MtnMomoServiceProvider::class,
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
}
