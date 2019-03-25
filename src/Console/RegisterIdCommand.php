<?php
/**
 * RegisterIdCommand.php
 */

namespace Bmatovu\MtnMomo\Console;

use Illuminate\Console\Command;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;
use Bmatovu\MtnMomo\Traits\CommandUtilTrait;

/**
 * Class RegisterIdCommand
 *
 * @package Bmatovu\MtnMomo\Console
 */
class RegisterIdCommand extends Command
{
    use CommandUtilTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtn-momo:register-id
                                {--id= : Client APP ID.}
                                {--callback= : Client APP redirect URI.}
                                {--d|debug= : Enable debugging for http requests.}
                                {--l|log=mtn-momo.log : Debug log file.}
                                {--f|force : Force the operation to run when in production.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Register client APP ID; 'apiuser'";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        // ...
    }

    /**
     * Execute the console command.
     *
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        if (! $this->runInProduction()) {
            return;
        }

        $this->printLabels('Client APP ID -> Registration');

        $client_id = $this->option('id');

        if (! $client_id) {
            $client_id = $this->laravel['config']->get('mtn-momo.app.id');
        }

        $client_redirect_uri = $this->option('callback');

        if (! $client_redirect_uri) {
            $client_redirect_uri = $this->laravel['config']->get('mtn-momo.app.redirect_uri');
        }

        $this->registerClientId($client_id, $client_redirect_uri);

        if ($this->confirm('Do you wish to request for the app secret?', true)) {
            $this->call('mtn-momo:request-secret', [
                '--id' => $client_id,
                '--force' => $this->option('force'),
                '--debug' => $this->option('debug'),
                '--log' => $this->option('log'),
            ]);
        }
    }

    /**
     * Register client ID.
     *
     * @param string $client_id
     * @param string $client_redirect_uri
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    protected function registerClientId($client_id, $client_redirect_uri)
    {
        try {
            $client = $this->prepareGuzzle(function () {
                echo '. ';
            }, $this->option('debug'));

            $response = $client->request('POST', $this->laravel['config']->get('mtn-momo.api.client_id_uri'), [
                'headers' => [
                    'X-Reference-Id' => $client_id,
                ],
                'json' => [
                    'providerCallbackHost' => $client_redirect_uri,
                ],
            ]);

            $this->line("\r\nStatus: <fg=green>".$response->getStatusCode().' '.$response->getReasonPhrase().'</>');

            $this->line("\r\nBody: <fg=green>".$response->getBody()."\r\n</>");
        } catch (ConnectException $ex) {
            $this->line("\r\n<fg=red>".$ex->getMessage().'</>');
        } catch (ClientException $ex) {
            $response = $ex->getResponse();
            $this->line("\r\nStatus: <fg=yellow>".$response->getStatusCode().' '.$response->getReasonPhrase().'</>');
            $this->line("\r\nBody: <fg=yellow>".$response->getBody()."\r\n</>");
        } catch (ServerException $ex) {
            $response = $ex->getResponse();
            $this->line("\r\nStatus: <fg=red>".$response->getStatusCode().' '.$response->getReasonPhrase().'</>');
            $this->line("\r\nBody: <fg=red>".$response->getBody()."\r\n</>");
        }
    }
}
