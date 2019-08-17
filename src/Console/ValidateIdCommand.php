<?php
/**
 * ValidateIdCommand.
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
 * Get client APP API credentials.
 *
 * @link https://momodeveloper.mtn.com/docs/services/sandbox-provisioning-api/operations/get-v1_0-apiuser Documenation.
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

        $client_id = $this->option('id');

        if (! $client_id) {
            $client_id = $this->laravel['config']->get("mtn-momo.products.{$product}.id");
        }

        $client_id = $this->ask('Use client app ID?', $client_id);

        while (! Uuid::isValid($client_id)) {
            $this->info(' Invalid UUID (Format: 4). #IETF RFC4122');
            $client_id = $this->ask('MOMO_CLIENT_ID');
        }

        $validate_id_uri = $this->laravel['config']->get('mtn-momo.api.validate_id_uri');

        $validate_id_uri = str_replace('{client_id}', $client_id, $validate_id_uri);

        $this->requestClientInfo($validate_id_uri);
    }

    /**
     * Request client credentials.
     *
     * @param string $client_id_status_uri
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return void
     */
    protected function requestClientInfo($client_id_status_uri)
    {
        try {
            $response = $this->client->request('GET', $client_id_status_uri, []);

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
