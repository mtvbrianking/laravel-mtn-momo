<?php

namespace Bmatovu\MtnMomo\Tests\Console;

use Bmatovu\MtnMomo\Tests\TestCase;

class BootstrapCommandTest extends TestCase
{
    /**
     * @test
     */
    public function canRequestSecret()
    {
        $this->markTestIncomplete('This test is imcomplete.');

        $this->artisan('mtn-momo:init')
             ->expectsOutput("\r\nStatus: 201 Created")
             ->expectsOutput("\r\nBody: {\"apiKey\":\"client-secret\"}\r\n")
             ->assertExitCode(0);

        $this->assertEquals($this->app['config']->get('mtn-momo.app.secret'), 'client-secret');
    }
}
