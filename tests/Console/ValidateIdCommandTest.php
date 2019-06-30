<?php

namespace Bmatovu\MtnMomo\Tests\Console;

use Bmatovu\MtnMomo\Tests\TestCase;

class ValidateIdCommandTest extends TestCase
{
    /**
     * @test
     */
    public function canValidateId()
    {
        $this->artisan('mtn-momo:validate-id')
             ->expectsOutput("\r\nStatus: 200 OK")
             ->expectsOutput("\r\nBody: {\"key\":\"value\"}\r\n")
             ->assertExitCode(0);
    }
}
