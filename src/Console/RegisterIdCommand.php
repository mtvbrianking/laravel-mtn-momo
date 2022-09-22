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
                                {--callback= : Client APP Callback URI.}
                                {--product= : Product subscribed to.}
                                {--no-write : Don\'t credentials to .env file.}
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

        $callbackUri = $this->getClientCallbackUri();

        $providerCallbackHost = parse_url($callbackUri)['host'] ?? '';

        $isRegistered = $this->registerClientId($id, $providerCallbackHost);

        if (! $isRegistered) {
            return;
        }

        $this->info('Writing configurations to .env file...');

        $this->updateSetting("MOMO_{$this->product}_ID", "mtn-momo.products.{$this->product}.id", $id);
        $this->updateSetting('MOMO_PROVIDER_CALLBACK_HOST', 'mtn-momo.provider_callback_host', $providerCallbackHost);
        $this->updateSetting("MOMO_{$this->product}_CALLBACK_URI", "mtn-momo.products.{$this->product}.callback_uri", $callbackUri);

        if (! $this->confirm('Do you wish to request for the app secret?', true)) {
            $this->info("\r\nNext: Validate your client application's ID.");
            $this->line("\r\n>>> php artisan mtn-momo:validate-id");

            return;
        }

        $this->call('mtn-momo:request-secret', [
            '--id' => $id,
            '--product' => $this->option('product'),
            '--force' => $this->option('force'),
        ]);
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

        $id = $this->option('id');

        if (! $id) {
            $id = $this->laravel['config']->get("mtn-momo.products.{$this->product}.id");
        }

        if (! $id) {
            $this->comment('> Generating random client ID...');

            $id = Uuid::uuid4()->toString();
        }

        $id = $this->ask('Use client app ID?', $id);

        while (! Uuid::isValid($id)) {
            $this->info(' Invalid UUID (Format: 4). #IETF RFC4122');
            $id = $this->ask('MOMO_CLIENT_ID');
        }

        return $id;
    }

    /**
     * Determine client Callback URI.
     *
     * @return string
     */
    protected function getClientCallbackUri()
    {
        $this->info('Client APP callback URI - [X-Callback-Url]');

        $callbackUri = $this->option('callback');

        if (! $callbackUri) {
            $callbackUri = $this->laravel['config']->get("mtn-momo.products.{$this->product}.callback_uri");
        }

        if (! $callbackUri) {
            $callbackUri = $this->laravel['config']->get('app.url');
        }

        $callbackUri = $this->ask('Use client app callback URI?', $callbackUri);

        while ($callbackUri && ! filter_var($callbackUri, FILTER_VALIDATE_URL)) {
            $this->info(' Invalid URI. #IETF RFC3986');
            $callbackUri = $this->ask('MOMO_CLIENT_CALLBACK_URI?');
        }

        return $callbackUri;
    }

    /**
     * Register client ID.
     *
     * The Callback URI is implemented in sandbox environment,
     * but is still required when registering a client ID.
     *
     * @link https://momodeveloper.mtn.com/docs/services/sandbox-provisioning-api/operations/post-v1_0-apiuser Documenation.
     *
     * @param string $clientId
     * @param string $providerCallbackHost
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return bool Is registered.
     */
    protected function registerClientId($clientId, $providerCallbackHost)
    {
        $this->info('Registering Client ID');

        $registerIdUri = $this->laravel['config']->get('mtn-momo.api.register_id_uri');

        try {
            $response = $this->client->request('POST', $registerIdUri, [
                'headers' => [
                    'X-Reference-Id' => $clientId,
                ],
                'json' => [
                    'providerCallbackHost' => $providerCallbackHost,
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
