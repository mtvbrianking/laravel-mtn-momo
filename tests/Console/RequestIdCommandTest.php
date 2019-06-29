<?php

namespace Bmatovu\MtnMomo\Tests\Console;

use Bmatovu\MtnMomo\Tests\TestCase;

class RequestIdCommandTest extends TestCase
{
    /**
     * @test
     *
     * @group current
     */
    public function canRequestId()
    {
        $this->artisan('mtn-momo:register-id')
             ->expectsOutput('Status: 201 Created')
             ->expectsQuestion('Do you wish to request for the app secret?', false)
             ->assertExitCode(0);
    }
}
