<?php
/**
 * RequestSecretCommand.
 */

namespace Bmatovu\MtnMomo\Console;

use Ramsey\Uuid\Uuid;
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
                                {--no-write= : Don\'t credentials to .env file.}
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
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return void
     */
    public function handle()
    {
        if (! $this->runInProduction()) {
            return;
        }

        $this->printLabels('Request -> Client APP secret');

        $client_id = $this->getClientId();

        $client_secret = $this->requestClientSecret($client_id);

        if (! $client_secret || $this->option('no-write')) {
            return;
        }

        $this->updateSetting('MOMO_CLIENT_SECRET', 'mtn-momo.app.secret', $client_secret);
    }

    /**
     * Determine client ID.
     *
     * @return string
     */
    protected function getClientId()
    {
        $this->info('Client APP ID - [X-Reference-Id, api_user_id]');

        // Client ID from command options.
        $id = $this->option('id');

        // Client ID from .env
        if (! $id) {
            $id = $this->laravel['config']->get('mtn-momo.app.id');
        }

        // Auto-generate client ID
        if (! $id) {
            $this->comment('> Generating random client ID...');

            $id = Uuid::uuid4()->toString();
        }

        // Confirm Client ID
        $id = $this->ask('Use client app ID?', $id);

        // Validate Client ID
        while (! Uuid::isValid($id)) {
            $this->info(' Invalid UUID (Format: 4). #IETF RFC4122');
            $id = $this->ask('MOMO_CLIENT_ID');
        }

        return $id;
    }

    /**
     * Request for client APP secret.
     *
     * @param string $client_id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return string Client Secret
     */
    protected function requestClientSecret($client_id)
    {
        try {
            $client_secret_uri = $this->laravel['config']->get('mtn-momo.api.client_secret_uri');

            $client_secret_uri = str_replace('{client_id}', $client_id, $client_secret_uri);

            $response = $this->client->request('POST', $client_secret_uri, []);

            $this->line("\r\nStatus: <fg=green>".$response->getStatusCode().' '.$response->getReasonPhrase().'</>');

            $this->line("\r\nBody: <fg=green>".$response->getBody()."</>\r\n");

            $api_response = json_decode($response->getBody(), true);

            return $api_response['apiKey'];
        } catch (ConnectException $ex) {
            $this->line("\r\n<fg=red>".$ex->getMessage().'</>');
        } catch (ClientException $ex) {
            $response = $ex->getResponse();
            $this->line("\r\nStatus: <fg=yellow>".$response->getStatusCode().' '.$response->getReasonPhrase().'</>');
            $this->line("\r\nBody: <fg=yellow>".$response->getBody()."</>\r\n");
        } catch (ServerException $ex) {
            $response = $ex->getResponse();
            $this->line("\r\nStatus: <fg=red>".$response->getStatusCode().' '.$response->getReasonPhrase().'</>');
            $this->line("\r\nBody: <fg=red>".$response->getBody()."</>\r\n");
        }
    }
}
