<?php
/**
 * ValidateIdCommand.php.
 */

namespace Bmatovu\MtnMomo\Console;

use Illuminate\Console\Command;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;
use Bmatovu\MtnMomo\Traits\CommandUtilTrait;

/**
 * Class ValidateIdCommand.
 */
class ValidateIdCommand extends Command
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
    protected $signature = 'mtn-momo:validate-id
                                {--id= : Client APP ID.}
                                {--d|debug= : Enable debugging for http requests.}
                                {--l|log=mtn-momo.log : Debug log file.}
                                {--f|force : Force the operation to run when in production.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Validate client APP ID; 'apiuser'";

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

        $this->printLabels('Client APP ID -> Validation');

        $client_id_status_uri = $this->laravel['config']->get('mtn-momo.api.client_id_status_uri');

        $client_id = $this->option('id');

        if ($client_id) {
            // Update client ID in uri.
            $client_id_status_uri = $this->prepareUri($client_id_status_uri, $client_id);
        } else {
            $client_id = $this->laravel['config']->get('mtn-momo.app.id');
        }

        $this->validateClientId($client_id_status_uri);
    }

    /**
     * Validate client APP ID.
     *
     * @param string $client_id_status_uri
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    protected function validateClientId($client_id_status_uri)
    {
        try {
            $client = $this->prepareGuzzle(function () {
                echo '. ';
            }, $this->option('debug'));

            $response = $client->request('GET', $client_id_status_uri, []);

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

    /**
     * Prepare URI with given params.
     *
     * @param  string $client_id_status_uri
     * @param  string $client_id
     * @return string
     */
    protected function prepareUri($client_id_status_uri, $client_id = null)
    {
        if (! $client_id) {
            return $client_id_status_uri;
        }

        $pattern = '/\b[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}\b/';
        $replacement = $client_id;

        return preg_replace($pattern, $replacement, $client_id_status_uri);
    }
}
