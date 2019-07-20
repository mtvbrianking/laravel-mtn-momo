<?php
namespace Bmatovu\MtnMomo\Tests\Console;

use Mockery as m;
use GuzzleHttp\Psr7\Response;
use Bmatovu\MtnMomo\Tests\TestCase;
use Illuminate\Container\Container;
use Illuminate\Contracts\Console\Kernel;
use Bmatovu\MtnMomo\Console\RegisterIdCommand;

/**
 * @see \Bmatovu\MtnMomo\Console\RegisterIdCommand
 */
class RegisterIdCommandTest extends TestCase
{
    public function test_doesnt_run_in_production()
    {
        // Mock production environment.
        $this->app['env'] = 'production';

        $apiResponse = new Response(201, [], null);

        $mockClient = $this->mockGuzzleClient($apiResponse);

        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\RegisterIdCommand[confirm,comment]', [$mockClient])
            ->shouldIgnoreMissing();

        $mockCommand->shouldReceive('confirm')
            ->once()
            ->with('Do you really wish to proceed?')
            ->andReturn(false);

        $mockCommand->shouldReceive('comment')->with('Command Cancelled!');

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $exitCode = $this->artisan('mtn-momo:register-id', [
            '--id' => 'd83eadba-a6b8-4301-b78e-454f73b5725c',
            '--callback' => 'https://example.com/mtn-momo/callback',
        ]);

        $this->assertEquals(0, $exitCode, "Expected status code 0 but received {$exitCode}.");
    }

    public function test_accept_run_in_production()
    {
        // Mock production environment.
        $this->app['env'] = 'production';

        $apiResponse = new Response(201, [], null);

        $mockClient = $this->mockGuzzleClient($apiResponse);

        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\RegisterIdCommand[confirm,comment]', [$mockClient])
            ->shouldIgnoreMissing();

        $mockCommand->shouldReceive('confirm')
            ->once()
            ->with('Do you really wish to proceed?')
            ->andReturn(true);

        $mockCommand->shouldNotReceive('comment')->with('Command Cancelled!');

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $exitCode = $this->artisan('mtn-momo:register-id', [
            '--id' => 'd83eadba-a6b8-4301-b78e-454f73b5725c',
            '--callback' => 'https://example.com/mtn-momo/callback',
        ]);

        $this->assertEquals(0, $exitCode, "Expected status code 0 but received {$exitCode}.");
    }

    public function test_force_run_in_production()
    {
        // Mock production environment.
        $this->app['env'] = 'production';

        $apiResponse = new Response(201, [], null);

        $mockClient = $this->mockGuzzleClient($apiResponse);

        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\RegisterIdCommand[confirm,comment]', [$mockClient])
            ->shouldIgnoreMissing();

        $mockCommand->shouldNotReceive('confirm')
            ->with('Do you really wish to proceed?');

        $mockCommand->shouldNotReceive('comment')->with('Command Cancelled!');

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $exitCode = $this->artisan('mtn-momo:register-id', [
            '--id' => 'd83eadba-a6b8-4301-b78e-454f73b5725c',
            '--callback' => 'https://example.com/mtn-momo/callback',
            '--force' => true,
        ]);

        $this->assertEquals(0, $exitCode, "Expected status code 0 but received {$exitCode}.");
    }

    public function test_command()
    {
        $apiResponse = new Response(201, [], null);

        $mockClient = $this->mockGuzzleClient($apiResponse);

        // $mockCommand = new RegisterIdCommand($mockClient);

        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\RegisterIdCommand[confirm]', [$mockClient]);

        $mockCommand->shouldReceive('confirm')
            ->once()
            ->with('Do you wish to request for the app secret?', true)
            ->andReturn(false);

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $exitCode = $this->artisan('mtn-momo:register-id', [
            '--id' => 'd83eadba-a6b8-4301-b78e-454f73b5725c',
            '--callback' => 'https://example.com/mtn-momo/callback',
            // '--no-interaction' => true,
        ]);

        $this->assertEquals(0, $exitCode, "Expected status code 0 but received {$exitCode}.");
    }
}
