<?php

namespace Bmatovu\MtnMomo\Tests\Console;

use Bmatovu\MtnMomo\Tests\TestCase;

class RequestIdCommandTest extends TestCase
{
    /**
     * @test
     */
    public function canRequestId()
    {
        $this->artisan('mtn-momo:register-id')
             ->expectsOutput("\r\nStatus: 201 Created")
             ->expectsQuestion('Do you wish to request for the app secret?', false)
             ->assertExitCode(0);
    }
}
