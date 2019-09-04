<?php
namespace Bmatovu\MtnMomo\Tests\Console;

use Mockery as m;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Bmatovu\MtnMomo\Tests\TestCase;
use Illuminate\Container\Container;
use Illuminate\Contracts\Console\Kernel;

/**
 * @see \Bmatovu\MtnMomo\Console\RequestSecretCommand
 */
class RequestSecretCommandTest extends TestCase
{
    public function test_request_client_secret()
    {
        $body = json_encode([
            'apiKey' => '78da1ff701e141d9f5b55f321f122ca7',
        ]);

        $response = new Response(201, [], $body);

        $mockClient = $this->mockGuzzleClient($response);

        $mockCommand = m::mock('Bmatovu\MtnMomo\Console\RequestSecretCommand[info,line,ask]', [$mockClient]);

        $mockCommand->shouldReceive('line')->once()->with('<options=bold>Request -> Client APP secret</>');

        $mockCommand->shouldReceive('info')->once()->with('Client APP ID - [X-Reference-Id, api_user_id]');

        $client_id = 'd83eadba-a6b8-4301-b78e-454f73b5725c';

        $mockCommand->shouldReceive('ask')
            ->once()
            ->with('Use client app ID?', $client_id)
            ->andReturn($client_id);

        $mockCommand->shouldReceive('line')->with("\r\nStatus: <fg=green>201 Created</>");

        $mockCommand->shouldReceive('line')->once()->with("\r\nBody: <fg=green>{$body}</>\r\n");

        Container::getInstance()->make(Kernel::class)->registerCommand($mockCommand);

        $this->artisan('mtn-momo:request-secret', [
            '--id' => $client_id,
        ])->assertExitCode(0);
    }
}
