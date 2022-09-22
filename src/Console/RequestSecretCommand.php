<?php
/**
 * RequestSecretCommand.
 */

namespace Bmatovu\MtnMomo\Console;

use Bmatovu\MtnMomo\Traits\CommandUtilTrait;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid;

/**
 * Request client app secret.
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
     * Product subscribed too.
     *
     * @var string
     */
    protected $product;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtn-momo:request-secret
                                {--id= : Client APP ID.}
                                {--product= : Product subscribed to.}
                                {--no-write : Don\'t credentials to .env file.}
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

        $this->product = $this->option('product');

        if (! $this->product) {
            $this->product = $this->laravel['config']->get('mtn-momo.product');
        }

        $clientId = $this->getClientId();

        $clientSecret = $this->requestClientSecret($clientId);

        if (! $clientSecret) {
            return;
        }

        $this->updateSetting("MOMO_{$this->product}_SECRET", "mtn-momo.products.{$this->product}.secret", $clientSecret);
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
            $id = $this->laravel['config']->get("mtn-momo.products.{$this->product}.id");
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
     * @link https://momodeveloper.mtn.com/docs/services/sandbox-provisioning-api/operations/post-v1_0-apiuser-apikey Documentation
     *
     * @param string $clientId
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return string|null Client Secret
     */
    protected function requestClientSecret($clientId)
    {
        try {
            $requestSecretUri = $this->laravel['config']->get('mtn-momo.api.request_secret_uri');

            $requestSecretUri = str_replace('{clientId}', $clientId, $requestSecretUri);

            $response = $this->client->request('POST', $requestSecretUri, []);

            $this->line("\r\nStatus: <fg=green>".$response->getStatusCode().' '.$response->getReasonPhrase().'</>');

            $this->line("\r\nBody: <fg=green>".$response->getBody()."</>\r\n");

            $apiResponse = json_decode($response->getBody(), true);

            return $apiResponse['apiKey'];
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

        return null;
    }
}
