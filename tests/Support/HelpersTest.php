<?php

namespace Bmatovu\MtnMomo\Tests\Support;

use Bmatovu\MtnMomo\Tests\TestCase;

/**
 * @see src/Support/helpers.php
 */
class HelpersTest extends TestCase
{
    public function test_example()
    {
        // Laravel
        $this->assertEquals(base_path('.env'), environment_file_path());
        $this->assertNotEquals(base_path('.env.fake'), environment_file_path('.env.fake'));

        // Lumen
        $this->assertEquals(base_path('.env'), environment_file_path('notFoundEnvFilePath'));
        $this->assertEquals(base_path('.env.fake'), environment_file_path('notFoundEnvFilePath', '.env.fake'));
    }
}
