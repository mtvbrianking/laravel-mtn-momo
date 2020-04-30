<?php

namespace Bmatovu\MtnMomo\Tests\Console;

use Bmatovu\MtnMomo\Tests\TestCase;
use GuzzleHttp\Psr7\Response;
use Illuminate\Container\Container;
use Illuminate\Contracts\Console\Kernel;
use Mockery as m;

/**
 * @see \Bmatovu\MtnMomo\Console\ValidateIdCommand
 */
class ValidateIdCommandTest extends TestCase
{
    public function test_request_client_info()
    {
        $body = json_encode([
            'providerCallbackHost' => 'https://example.com/mtn-momo/callback',
            'targetEnvironment' => 'sandbox',
        ]);

        $response = new Response(201, [], $body);

        $mockClient = $this->mockGuzzleClient($response);

        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\ValidateIdCommand[line,ask]', [$mockClient]);

        $mockCommand->shouldReceive('line')->with('<options=bold>Client APP ID -> Validation</>');

        $client_id = 'd83eadba-a6b8-4301-b78e-454f73b5725c';

        $mockCommand->shouldReceive('ask')
            ->once()
            ->with('Use client app ID?', $client_id)
            ->andReturn($client_id);

        $mockCommand->shouldReceive('line')->with("\r\nStatus: <fg=green>201 Created</>");

        $mockCommand->shouldReceive('line')->once()->with("\r\nBody: <fg=green>{$body}</>\r\n");

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $this->artisan('mtn-momo:validate-id', [
            '--id' => $client_id,
            '--product' => 'collection',
        ])->assertExitCode(0);
    }
}
