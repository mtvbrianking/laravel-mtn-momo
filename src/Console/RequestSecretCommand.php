<?php
/**
 * RequestSecretCommand.
 */

namespace Bmatovu\MtnMomo\Console;

use GuzzleHttp\ClientInterface;
use Illuminate\Console\Command;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;
use Bmatovu\MtnMomo\Traits\CommandUtilTrait;

/**
 * Class RequestSecretCommand.
 */
class RequestSecretCommand extends Command
{
    use CommandUtilTrait;

    /**
     * Guzzle HTTP client instance.
     *
     * @var \GuzzleHttp\ClientInterface
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
     * @param \GuzzleHttp\ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        parent::__construct();

        $this->client = $client;
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

        $client_id = $this->option('id');

        if (! $client_id) {
            $client_id = $this->laravel['config']->get('mtn-momo.app.id');
        }

        $this->printLabels('Request -> Client APP secret');

        $this->requestClientSecret($client_id);
    }

    /**
     * Request for client APP secret.
     *
     * @param string $client_id
     *
     * @return void
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function requestClientSecret($client_id)
    {
        try {
            $client_secret_uri = $this->laravel['config']->get('mtn-momo.api.client_secret_uri');

            $response = $this->client->request('POST', $this->prepareUri($client_secret_uri, $client_id), []);

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
     * Prepare URI with given params.
     *
     * @param  string $client_secret_uri
     * @param  string $client_id
     * @return string
     */
    protected function prepareUri($client_secret_uri, $client_id = null)
    {
        if (! $client_id) {
            return $client_secret_uri;
        }

        $patterns = $replacements = [];

        $patterns[] = '/\b[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}\b/';
        $replacements[] = $client_id;

        $patterns[] = '/(?<!:)(\/\/)/';
        $replacements[] = "/{$client_id}/";

        return preg_replace($patterns, $replacements, $client_secret_uri);
    }
}
