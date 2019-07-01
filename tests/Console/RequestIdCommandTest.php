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
        $this->artisan('mtn-momo:register-id --id="0a71b3c2-eae2-46b2-97af-32149f142d29"')
             ->expectsOutput("\r\nStatus: 201 Created")
             ->expectsQuestion('Do you wish to request for the app secret?', false)
             ->assertExitCode(0);
    }
}
