<?php

namespace Bmatovu\MtnMomo\Tests\Console;

use Bmatovu\MtnMomo\Tests\TestCase;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Container\Container;
use Illuminate\Contracts\Console\Kernel;
use Mockery as m;

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

        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\RegisterIdCommand[comment,confirm,info]', [$mockClient])
            ->shouldIgnoreMissing();

        $mockCommand->shouldReceive('confirm')
            ->once()
            ->with('Do you really wish to proceed?')
            ->andReturn(false);

        $mockCommand->shouldReceive('comment')->once()->with('Command Cancelled!');

        $mockCommand->shouldNotReceive('info')->with('Client APP ID - [X-Reference-Id, api_user_id]');

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $this->artisan('mtn-momo:register-id', [
            '--id' => 'd83eadba-a6b8-4301-b78e-454f73b5725c',
            '--callback' => 'https://example.com/mtn-momo/callback',
            '--no-interaction' => true,
        ])->assertExitCode(0);
    }

    public function test_accept_run_in_production()
    {
        // Mock production environment.
        $this->app['env'] = 'production';

        $apiResponse = new Response(201, [], null);

        $mockClient = $this->mockGuzzleClient($apiResponse);

        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\RegisterIdCommand[ask,confirm,comment,info]', [$mockClient])
            ->shouldIgnoreMissing();

        $mockCommand->shouldReceive('confirm')
            ->once()
            ->with('Do you really wish to proceed?')
            ->andReturn(true);

        $mockCommand->shouldNotReceive('comment')->with('Command Cancelled!');

        $mockCommand->shouldReceive('info')->once()->with('Client APP ID - [X-Reference-Id, api_user_id]');

        $mockCommand->shouldReceive('ask')
            ->once()
            ->with('Use client app ID?', 'd83eadba-a6b8-4301-b78e-454f73b5725c')
            ->andReturn('d83eadba-a6b8-4301-b78e-454f73b5725c');

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $this->artisan('mtn-momo:register-id', [
            '--id' => 'd83eadba-a6b8-4301-b78e-454f73b5725c',
            '--callback' => 'https://example.com/mtn-momo/callback',
            '--no-interaction' => true,
        ])->assertExitCode(0);
    }

    public function test_force_run_in_production()
    {
        // Mock production environment.
        $this->app['env'] = 'production';

        $apiResponse = new Response(201, [], null);

        $mockClient = $this->mockGuzzleClient($apiResponse);

        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\RegisterIdCommand[ask,confirm,comment,info]', [$mockClient])
            ->shouldIgnoreMissing();

        $mockCommand->shouldNotReceive('confirm')->with('Do you really wish to proceed?');

        $mockCommand->shouldNotReceive('comment')->with('Command Cancelled!');

        $mockCommand->shouldReceive('info')->once()->with('Client APP ID - [X-Reference-Id, api_user_id]');

        $mockCommand->shouldReceive('ask')
            ->once()
            ->with('Use client app ID?', 'd83eadba-a6b8-4301-b78e-454f73b5725c')
            ->andReturn('d83eadba-a6b8-4301-b78e-454f73b5725c');

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $this->artisan('mtn-momo:register-id', [
            '--id' => 'd83eadba-a6b8-4301-b78e-454f73b5725c',
            '--callback' => 'https://example.com/mtn-momo/callback',
            '--force' => true,
            '--no-interaction' => true,
        ])->assertExitCode(0);
    }

    public function test_server_unreachable()
    {
        $apiResponse = new ConnectException('Could not resolve host', new Request('GET', 'test'));

        $mockClient = $this->mockGuzzleClient($apiResponse);

        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\RegisterIdCommand[ask,info,confirm]', [$mockClient])
            ->shouldIgnoreMissing();

        $mockCommand->shouldReceive('info')->once()->with('Client APP ID - [X-Reference-Id, api_user_id]');

        $mockCommand->shouldReceive('info')->once()->with('Client APP callback URI - [X-Callback-Url]');

        $mockCommand->shouldReceive('ask')
            ->once()
            ->with('Use client app ID?', 'd83eadba-a6b8-4301-b78e-454f73b5725c')
            ->andReturn('d83eadba-a6b8-4301-b78e-454f73b5725c');

        $mockCommand->shouldReceive('info')->once()->with('Registering Client ID');

        $mockCommand->shouldReceive('line')->with("\r\n<fg=red>Could not resolve host</>");

        $mockCommand->shouldNotReceive('confirm')
            ->with('Do you wish to request for the app secret?', true);

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $this->artisan('mtn-momo:register-id', [
            '--id' => 'd83eadba-a6b8-4301-b78e-454f73b5725c',
            '--callback' => 'https://example.com/mtn-momo/callback',
            '--no-interaction' => true,
        ])->assertExitCode(0);
    }

    public function test_register_client_id()
    {
        $apiResponse = new Response(201, [], null);

        $mockClient = $this->mockGuzzleClient($apiResponse);

        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\RegisterIdCommand[ask,info,line,confirm]', [$mockClient])
            ->shouldIgnoreMissing();

        $mockCommand->shouldReceive('info')->once()->with('Client APP ID - [X-Reference-Id, api_user_id]');

        $mockCommand->shouldReceive('info')->once()->with('Client APP callback URI - [X-Callback-Url]');

        $mockCommand->shouldReceive('ask')
            ->once()
            ->with('Use client app ID?', 'd83eadba-a6b8-4301-b78e-454f73b5725c')
            ->andReturn('d83eadba-a6b8-4301-b78e-454f73b5725c');

        $mockCommand->shouldReceive('ask')
            ->once()
            ->with('Use client app callback URI?', 'https://example.com/mtn-momo/callback')
            ->andReturn('https://example.com/mtn-momo/callback');

        $mockCommand->shouldReceive('info')->once()->with('Registering Client ID');

        $mockCommand->shouldReceive('line')->once()->with("\r\nStatus: <fg=green>201 Created</>");

        $mockCommand->shouldReceive('info')->once()->with('Writing configurations to .env file...');

        $mockCommand->shouldReceive('confirm')
            ->once()
            ->with('Do you wish to request for the app secret?', true)
            ->andReturn(false);

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $this->artisan('mtn-momo:register-id', [
            '--id' => 'd83eadba-a6b8-4301-b78e-454f73b5725c',
            '--callback' => 'https://example.com/mtn-momo/callback',
            '--no-interaction' => true,
        ])->assertExitCode(0);
    }

    public function test_register_duplicate_client_id()
    {
        $err_body = json_encode([
            'message' => 'Duplicated reference id. Creation of resource failed.',
            'status' => 'RESOURCE_ALREADY_EXIST',
        ]);

        $apiResponses = [
            new Response(201, [], null),
            new Response(409, [], $err_body),
        ];

        $mockClient = $this->mockGuzzleClient($apiResponses);

        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\RegisterIdCommand[ask,info,line,confirm]', [$mockClient])
            ->shouldIgnoreMissing();

        $mockCommand->shouldReceive('ask')
            ->with('Use client app ID?', 'd83eadba-a6b8-4301-b78e-454f73b5725c')
            ->andReturn('d83eadba-a6b8-4301-b78e-454f73b5725c');

        $mockCommand->shouldReceive('ask')
            ->with('Use client app callback URI?', 'https://example.com/mtn-momo/callback')
            ->andReturn('https://example.com/mtn-momo/callback');

        $mockCommand->shouldReceive('info')->once()->with('Registering Client ID');

        $mockCommand->shouldReceive('line')->once()->with("\r\nStatus: <fg=green>201 Created</>");

        $mockCommand->shouldReceive('confirm')
            ->once()
            ->with('Do you wish to request for the app secret?', true)
            ->andReturn(false);

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $this->artisan('mtn-momo:register-id', [
            '--id' => 'd83eadba-a6b8-4301-b78e-454f73b5725c',
            '--callback' => 'https://example.com/mtn-momo/callback',
            '--no-interaction' => true,
        ])->assertExitCode(0);

        // Re-registration

        $mockCommand->shouldReceive('info')->once()->with('Registering Client ID');

        $mockCommand->shouldReceive('line')->once()->with("\r\nStatus: <fg=yellow>409 Conflict</>");

        $mockCommand->shouldReceive('line')->once()->with("\r\nBody: <fg=yellow>{$err_body}\r\n</>");

        $this->artisan('mtn-momo:register-id', [
            '--id' => 'd83eadba-a6b8-4301-b78e-454f73b5725c',
            '--callback' => 'https://example.com/mtn-momo/callback',
            '--no-interaction' => true,
        ])->assertExitCode(0);
    }
}
