<?php

namespace Bmatovu\MtnMomo\Test\Console;

use Bmatovu\MtnMomo\Test\TestCase;

class BootstrapCommandTest extends TestCase
{
    public function testCanCreateAppName()
    {
        // Run mtn-momo:init
        // Question: "MOMO_APP_NAME?"
        // Answer: "Test Momo App"
        // Assert MOMO_APP_NAME is created in .env
    }

    public function testCanUpdateAppName()
    {
        // Run mtn-momo:init
        // Question: "MOMO_APP_NAME?"
        // Answer: "Test Momo App"
        // Assert MOMO_APP_NAME is updated in .env
    }
}
