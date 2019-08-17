<?php
namespace Bmatovu\MtnMomo\Tests\Console;

use Mockery as m;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Bmatovu\MtnMomo\Tests\TestCase;
use Illuminate\Container\Container;
use Illuminate\Contracts\Console\Kernel;
use GuzzleHttp\Exception\ConnectException;

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

        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\RegisterIdCommand[confirm,comment,info]', [$mockClient])
            ->shouldIgnoreMissing();

        $mockCommand->shouldReceive('confirm')
            ->once()
            ->with('Do you really wish to proceed?')
            ->andReturn(false);

        $mockCommand->shouldReceive('comment')->once()->with('Command Cancelled!');

        $mockCommand->shouldNotReceive('info')->with('Client APP ID - [X-Reference-Id, api_user_id]');

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

        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\RegisterIdCommand[confirm,comment,info]', [$mockClient])
            ->shouldIgnoreMissing();

        $mockCommand->shouldReceive('confirm')
            ->once()
            ->with('Do you really wish to proceed?')
            ->andReturn(true);

        $mockCommand->shouldNotReceive('comment')->with('Command Cancelled!');

        $mockCommand->shouldReceive('info')->once()->with('Client APP ID - [X-Reference-Id, api_user_id]');

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $exitCode = $this->artisan('mtn-momo:register-id', [
            '--id' => 'd83eadba-a6b8-4301-b78e-454f73b5725c',
            '--callback' => 'https://example.com/mtn-momo/callback',
            '--no-interaction' => true,
        ]);

        $this->assertEquals(0, $exitCode, "Expected status code 0 but received {$exitCode}.");
    }

    public function test_force_run_in_production()
    {
        // Mock production environment.
        $this->app['env'] = 'production';

        $apiResponse = new Response(201, [], null);

        $mockClient = $this->mockGuzzleClient($apiResponse);

        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\RegisterIdCommand[confirm,comment,info]', [$mockClient])
            ->shouldIgnoreMissing();

        $mockCommand->shouldNotReceive('confirm')->with('Do you really wish to proceed?');

        $mockCommand->shouldNotReceive('comment')->with('Command Cancelled!');

        $mockCommand->shouldReceive('info')->once()->with('Client APP ID - [X-Reference-Id, api_user_id]');

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $exitCode = $this->artisan('mtn-momo:register-id', [
            '--id' => 'd83eadba-a6b8-4301-b78e-454f73b5725c',
            '--callback' => 'https://example.com/mtn-momo/callback',
            '--force' => true,
            '--no-interaction' => true,
        ]);

        $this->assertEquals(0, $exitCode, "Expected status code 0 but received {$exitCode}.");
    }

    public function test_server_unreachable()
    {
        $apiResponse = new ConnectException('Could not resolve host', new Request('GET', 'test'));

        $mockClient = $this->mockGuzzleClient($apiResponse);

        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\RegisterIdCommand[info,confirm]', [$mockClient]);

        $mockCommand->shouldReceive('info')->once()->with('Client APP ID - [X-Reference-Id, api_user_id]');

        $mockCommand->shouldReceive('info')->once()->with('Client APP redirect URI - [X-Callback-Url, providerCallbackHost]');

        $mockCommand->shouldReceive('info')->once()->with('Registering Client ID');

        $mockCommand->shouldReceive('line')->with("\r\n<fg=red>Could not resolve host</>");

        $mockCommand->shouldNotReceive('confirm')
            ->with('Do you wish to request for the app secret?', true);

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $exitCode = $this->artisan('mtn-momo:register-id', [
            '--id' => 'd83eadba-a6b8-4301-b78e-454f73b5725c',
            '--callback' => 'https://example.com/mtn-momo/callback',
            '--no-interaction' => true,
        ]);

        $this->assertEquals(0, $exitCode, "Expected status code 0 but received {$exitCode}.");
    }

    public function test_register_client_id()
    {
        $apiResponse = new Response(201, [], null);

        $mockClient = $this->mockGuzzleClient($apiResponse);

        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\RegisterIdCommand[info,line,confirm]', [$mockClient]);

        $mockCommand->shouldReceive('info')->once()->with('Client APP ID - [X-Reference-Id, api_user_id]');

        $mockCommand->shouldReceive('info')->once()->with('Client APP redirect URI - [X-Callback-Url, providerCallbackHost]');

        $mockCommand->shouldReceive('info')->once()->with('Registering Client ID');

        $mockCommand->shouldReceive('line')->once()->with("\r\nStatus: <fg=green>201 Created</>");

        $mockCommand->shouldReceive('info')->once()->with('Writing configurations to .env file...');

        $mockCommand->shouldReceive('confirm')
            ->once()
            ->with('Do you wish to request for the app secret?', true)
            ->andReturn(false);

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $exitCode = $this->artisan('mtn-momo:register-id', [
            '--id' => 'd83eadba-a6b8-4301-b78e-454f73b5725c',
            '--callback' => 'https://example.com/mtn-momo/callback',
            '--no-interaction' => true,
        ]);

        $this->assertEquals(0, $exitCode, "Expected status code 0 but received {$exitCode}.");
    }

    public function test_register_duplicate_client_id()
    {
        $err_body = json_encode([
            'message' => 'Duplicated reference id. Creation of resource failed.',
            'status' => 'RESOURCE_ALREADY_EXIST',
        ]);

        $apiResponses = [
            new Response(201, [], null),
            new Response(409, [], $err_body)
        ];

        $mockClient = $this->mockGuzzleClient($apiResponses);

        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\RegisterIdCommand[info,line,confirm]', [$mockClient])
            ->shouldIgnoreMissing();

        $mockCommand->shouldReceive('info')->once()->with('Registering Client ID');

        $mockCommand->shouldReceive('line')->once()->with("\r\nStatus: <fg=green>201 Created</>");

        $mockCommand->shouldReceive('confirm')
            ->once()
            ->with('Do you wish to request for the app secret?', true)
            ->andReturn(false);

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $exitCode = $this->artisan('mtn-momo:register-id', [
            '--id' => 'd83eadba-a6b8-4301-b78e-454f73b5725c',
            '--callback' => 'https://example.com/mtn-momo/callback',
            '--no-interaction' => true,
        ]);

        $this->assertEquals(0, $exitCode, "Expected status code 0 but received {$exitCode}.");

        // Re-registration

        $mockCommand->shouldReceive('info')->once()->with('Registering Client ID');

        $mockCommand->shouldReceive('line')->once()->with("\r\nStatus: <fg=yellow>409 Conflict</>");

        $mockCommand->shouldReceive('line')->once()->with("\r\nBody: <fg=yellow>{$err_body}\r\n</>");

        $exitCode = $this->artisan('mtn-momo:register-id', [
            '--id' => 'd83eadba-a6b8-4301-b78e-454f73b5725c',
            '--callback' => 'https://example.com/mtn-momo/callback',
            '--no-interaction' => true,
        ]);

        $this->assertEquals(0, $exitCode, "Expected status code 0 but received {$exitCode}.");
    }
}
