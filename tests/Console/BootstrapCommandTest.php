<?php

namespace Bmatovu\MtnMomo\Tests\Console;

use Bmatovu\MtnMomo\Tests\TestCase;

class BootstrapCommandTest extends TestCase
{
    public function testCanCreateAppName()
    {
        // Run momo:init
        // Question: "MOMO_CLIENT_NAME?"
        // Answer: "Test Momo App"
        // Assert MOMO_CLIENT_NAME is created in .env
    }

    public function testCanUpdateAppName()
    {
        // Run momo:init
        // Question: "MOMO_APP_NAME?"
        // Answer: "Test Momo App"
        // Assert MOMO_CLIENT_NAME is updated in .env
    }
}
