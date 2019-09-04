<?php
namespace Bmatovu\MtnMomo\Tests\Console;

use Mockery as m;
use Illuminate\Container\Container;
use Bmatovu\MtnMomo\Tests\TestCase;
use Illuminate\Contracts\Console\Kernel;

/**
 * @see \Bmatovu\MtnMomo\Console\BootstrapCommand
 */
class BootstrapCommandTest extends TestCase
{
    public function test_update_env_settings()
    {
        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\BootstrapCommand[ask,choice,line]')
            ->shouldIgnoreMissing();

        $mockCommand->shouldReceive('line')->with('<options=bold>Product</>');

        $mockCommand->shouldReceive('choice')
            ->once()
            ->with('MOMO_PRODUCT', ['collection', 'disbursement', 'remittance'], 0)
            ->andReturn('collection');

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $this->artisan('mtn-momo:init', [
            '--no-interaction' => true,
        ])->assertExitCode(0);

        $env = file_get_contents(base_path('.env'));

        $pattern = "/^MOMO_PRODUCT=[\"']?collection[\"']?/m";

        $this->assertEquals(1, preg_match($pattern, $env));

        // Test update setting

        $mockCommand->shouldReceive('choice')
            ->once()
            ->with('MOMO_PRODUCT', ['collection', 'disbursement', 'remittance'], 0)
            ->andReturn('disbursement');

        $this->artisan('mtn-momo:init', [
            '--no-interaction' => true,
        ])->assertExitCode(0);

        $env = file_get_contents(base_path('.env'));

        $pattern = "/^MOMO_PRODUCT=[\"']?disbursement[\"']?/m";

        $this->assertEquals(1, preg_match($pattern, $env));
    }

    public function test_set_product()
    {
        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\BootstrapCommand[ask,choice,line]')
            ->shouldIgnoreMissing();

        $mockCommand->shouldReceive('line')->once()->with('<options=bold>Product</>');

        $mockCommand->shouldReceive('choice')
            ->once()
            ->with('MOMO_PRODUCT', ['collection', 'disbursement', 'remittance'], 0)
            ->andReturn('collection');

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $this->artisan('mtn-momo:init', [
            '--no-interaction' => true,
        ])->assertExitCode(0);
    }

    public function test_set_product_key()
    {
        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\BootstrapCommand[ask,choice,line]')
            ->shouldIgnoreMissing();

        $mockCommand->shouldReceive('line')->once()->with('<options=bold>Product subscription key</>');

        $mockCommand->shouldReceive('choice')
            ->once()
            ->with('MOMO_PRODUCT', ['collection', 'disbursement', 'remittance'], 0)
            ->andReturn('collection');

        $mockCommand->shouldReceive('ask')
            ->once()
            ->with('MOMO_COLLECTION_SUBSCRIPTION_KEY', null)
            ->andReturn('baf309d73a34435190410e9a47a377f4');

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $this->artisan('mtn-momo:init', [
            '--no-interaction' => true,
        ])->assertExitCode(0);
    }

    public function test_set_environment()
    {
        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\BootstrapCommand[ask,choice,line]')
            ->shouldIgnoreMissing();

        $mockCommand->shouldReceive('line')->once()->with('<options=bold>Product</>');

        $mockCommand->shouldReceive('choice')
            ->once()
            ->with('MOMO_ENVIRONMENT', ['sandbox', 'live'], 0)
            ->andReturn('sandbox');

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $this->artisan('mtn-momo:init', [
            '--no-interaction' => true,
        ])->assertExitCode(0);
    }

    public function test_set_currency()
    {
        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\BootstrapCommand[ask,choice,line]')
            ->shouldIgnoreMissing();

        $mockCommand->shouldReceive('line')->once()->with('<options=bold>Currency</>');

        $mockCommand->shouldReceive('ask')
            ->once()
            ->with('MOMO_CURRENCY', 'EUR')
            ->andReturn('EUR');

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $this->artisan('mtn-momo:init', [
            '--no-interaction' => true,
        ])->assertExitCode(0);
    }

    public function test_set_client_name()
    {
        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\BootstrapCommand[ask,choice,line]')
            ->shouldIgnoreMissing();

        $mockCommand->shouldReceive('line')->once()->with('<options=bold>Client APP name</>');

        $mockCommand->shouldReceive('ask')
            ->once()
            ->with('MOMO_APP', 'Laravel MTN Momo')
            ->andReturn('TestMomoApp');

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $this->artisan('mtn-momo:init', [
            '--no-interaction' => true,
        ])->assertExitCode(0);
    }
}
