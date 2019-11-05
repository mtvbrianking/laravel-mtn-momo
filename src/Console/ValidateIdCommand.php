<?php
/**
 * ValidateIdCommand.
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
 * Get client APP API credentials.
 */
class ValidateIdCommand extends Command
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
    protected $signature = 'mtn-momo:validate-id
                                {--id= : Client APP ID.}
                                {--product= : Product subscribed to.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Validate client APP ID; 'apiuser'.";

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
        $this->printLabels('Client APP ID -> Validation');

        $product = $this->option('product');

        if (! $product) {
            $product = $this->laravel['config']->get('mtn-momo.product');
        }

        $clientId = $this->option('id');

        if (! $clientId) {
            $clientId = $this->laravel['config']->get("mtn-momo.products.{$product}.id");
        }

        $clientId = $this->ask('Use client app ID?', $clientId);

        while (! Uuid::isValid($clientId)) {
            $this->info(' Invalid UUID (Format: 4). #IETF RFC4122');
            $clientId = $this->ask('MOMO_CLIENT_ID');
        }

        $validateIdUri = $this->laravel['config']->get('mtn-momo.api.validate_id_uri');

        $validateIdUri = str_replace('{clientId}', $clientId, $validateIdUri);

        $this->requestClientInfo($validateIdUri);
    }

    /**
     * Request client credentials.
     *
     * @link https://momodeveloper.mtn.com/docs/services/sandbox-provisioning-api/operations/get-v1_0-apiuser Documenation.
     *
     * @param string $clientIdStatusUri
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return void
     */
    protected function requestClientInfo($clientIdStatusUri)
    {
        try {
            $response = $this->client->request('GET', $clientIdStatusUri, []);

            $this->line("\r\nStatus: <fg=green>".$response->getStatusCode().' '.$response->getReasonPhrase().'</>');

            $this->line("\r\nBody: <fg=green>".$response->getBody()."</>\r\n");
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
