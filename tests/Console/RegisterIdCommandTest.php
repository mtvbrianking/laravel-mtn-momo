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
    /**
     * @see \Bmatovu\MtnMomo\Console\RegisterIdCommand::handle
     */
    public function testCommand()
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

        $this->artisan('mtn-momo:register-id', [
            '--id' => 'd83eadba-a6b8-4301-b78e-454f73b5725c',
            '--callback' => 'https://example.com/mtn-momo/callback',
            // '--no-interaction' => true,
        ]);
    }
}
