<?php
/**
 * src/Console/RegisterIdCommand.php.
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
 * Register client ID in sandbox environment.
 *
 * The client application ID is a user generate UUID format 4,
 * that is then registered with MTN Momo API.
 */
class RegisterIdCommand extends Command
{
    use CommandUtilTrait;

    /**
     * Guzzle HTTP client instance.
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * Product subscribed to.
     *
     * @var string
     */
    protected $product;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtn-momo:register-id
                                {--id= : Client APP ID.}
                                {--callback= : Client APP redirect URI.}
                                {--product= : Product subscribed to.}
                                {--no-write= : Don\'t credentials to .env file.}
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

        $this->product = $this->option('product');

        if (! $this->product) {
            $this->product = $this->laravel['config']->get('mtn-momo.product');
        }

        $id = $this->getClientId();

        $redirectUri = $this->getClientRedirectUri();

        $isRegistered = $this->registerClientId($id, $redirectUri);

        if (! $isRegistered) {
            return;
        }

        $this->info('Writing configurations to .env file...');

        $this->updateSetting("MOMO_{$this->product}_ID", "mtn-momo.products.{$this->product}.id", $id);
        $this->updateSetting("MOMO_{$this->product}_REDIRECT_URI", "mtn-momo.products.{$this->product}.redirect_uri", $redirectUri);

        if ($this->confirm('Do you wish to request for the app secret?', true)) {
            $this->call('mtn-momo:request-secret', [
                '--id' => $id,
                '--product' => $this->option('product'),
                '--force' => $this->option('force'),
            ]);
        }
    }

    /**
     * Determine client ID.
     *
     * @throws \Exception
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
     * Determine client redirect URI.
     *
     * @return string
     */
    protected function getClientRedirectUri()
    {
        $this->info('Client APP redirect URI - [X-Callback-Url, providerCallbackHost]');

        // Client redirect URI from command options.
        $redirectUri = $this->option('callback');

        // Client redirect URI from .env
        if (! $redirectUri) {
            $redirectUri = $this->laravel['config']->get("mtn-momo.products.{$this->product}.redirect_uri");
        }

        $redirectUri = $this->ask('Use client app redirect URI?', $redirectUri);

        // Validate Client redirect URI
        while ($redirectUri && ! filter_var($redirectUri, FILTER_VALIDATE_URL)) {
            $this->info(' Invalid URI. #IETF RFC3986');
            $redirectUri = $this->ask('MOMO_CLIENT_REDIRECT_URI?', false);
        }

        return $redirectUri;
    }

    /**
     * Register client ID.
     *
     * The redirect URI is implemented in sandbox environment,
     * but is still required when registering a client ID.
     *
     * @link https://momodeveloper.mtn.com/docs/services/sandbox-provisioning-api/operations/post-v1_0-apiuser Documenation.
     *
     * @param string $clientId
     * @param string $clientRedirectUri
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return bool Is registered.
     */
    protected function registerClientId($clientId, $clientRedirectUri)
    {
        $this->info('Registering Client ID');

        $registerIdUri = $this->laravel['config']->get('mtn-momo.api.register_id_uri');

        try {
            $response = $this->client->request('POST', $registerIdUri, [
                'headers' => [
                    'X-Reference-Id' => $clientId,
                ],
                'json' => [
                    'providerCallbackHost' => $clientRedirectUri,
                ],
            ]);

            $this->line("\r\nStatus: <fg=green>".$response->getStatusCode().' '.$response->getReasonPhrase().'</>');

            return true;
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

        return false;
    }
}
