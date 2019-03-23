<?php

namespace Bmatovu\MtnMomo\Console;

use Illuminate\Console\Command;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;
use Bmatovu\MtnMomo\Traits\CommandUtilTrait;

class RegisterIdCommand extends Command
{
    use CommandUtilTrait;

    /**
     * Guzzle http client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

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
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        if (! $this->runInProduction()) {
            return;
        }

        $this->printLabels('Client APP ID -> Registration');

        $id = $this->option('id');

        if (! $id) {
            $id = $this->laravel['config']->get('mtn-momo.app.id');
        }

        $redirect_uri = $this->option('callback');

        if (! $redirect_uri) {
            $redirect_uri = $this->laravel['config']->get('mtn-momo.app.redirect_uri');
        }

        $this->registerClientId($id, $redirect_uri);

        if ($this->confirm('Do you wish to request for the app secret?', true)) {
            $this->call('mtn-momo:request-secret', [
                '--id' => $id,
                '--force' => $this->option('force'),
                '--debug' => $this->option('debug'),
                '--log' => $this->option('log'),
            ]);
        }
    }

    /**
     * Register client ID.
     *
     * @param $client_id
     * @param $client_redirect_uri
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function registerClientId($client_id, $client_redirect_uri)
    {
        try {
            $client = $this->prepareGuzzle(function () {
                echo '. ';
            }, $this->option('debug'));

            $response = $client->request('POST', $this->laravel['config']->get('mtn-momo.api.client_id_uri').'/unknown', [
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
