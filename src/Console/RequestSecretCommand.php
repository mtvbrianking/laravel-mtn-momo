<?php

namespace Bmatovu\MtnMomo\Console;

use Illuminate\Console\Command;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;
use Bmatovu\MtnMomo\Traits\CommandUtilTrait;

class RequestSecretCommand extends Command
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
    protected $signature = 'mtn-momo:request-secret
                                {--id= : Client APP ID.}
                                {--d|debug= : Enable debugging for http requests.}
                                {--l|log=mtn-momo.log : Debug log file.}
                                {--f|force : Force the operation to run when in production.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Request client APP secret; 'apikey'.";

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

        $id = $this->option('id');

        if (! $id) {
            $id = $this->laravel['config']->get('mtn-momo.app.id');
        }

        $this->printLabels('Request -> Client APP secret');

        $this->requestClientSecret($id);
    }

    /**
     * Request for client secret.
     *
     * @param $client_id
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function requestClientSecret($client_id)
    {
        try {
            $client = $this->prepareGuzzle(function () {
                echo '. ';
            }, $this->option('debug'));

            $client_secret_uri = $this->laravel['config']->get('mtn-momo.api.client_secret_uri');

            $response = $client->request('POST', $this->cleanUri($client_secret_uri, $client_id).'/unknown', []);

            $this->line("\r\nStatus: <fg=green>".$response->getStatusCode().' '.$response->getReasonPhrase().'</>');

            $this->line("\r\nBody: <fg=green>".$response->getBody()."\r\n</>");

            $api_response = json_decode($response->getBody(), true);

            $client_secret = $api_response['apiKey'];

            $this->updateSetting('MOMO_CLIENT_SECRET', 'mtn-momo.app.secret', $client_secret);
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

    /**
     * Reassemble route in memory.
     *
     * @param  string $uri
     * @param  string $uuid Client ID
     * @return string
     */
    protected function cleanUri($uri, $uuid = null)
    {
        if (is_null($uuid)) {
            $uuid = $this->laravel['config']['mtn-momo.app.id'];
        }

        $patterns[] = '/\b[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}\b/';
        $replacements[] = $uuid;

        $patterns[] = '/(?<!:)(\/\/)/';
        $replacements[] = "/{$uuid}/";

        return preg_replace($patterns, $replacements, $uri);
    }
}
