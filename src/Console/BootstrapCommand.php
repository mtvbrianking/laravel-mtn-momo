<?php

namespace Bmatovu\MtnMomo\Console;

use Monolog\Logger;
use Ramsey\Uuid\Uuid;
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use Illuminate\Console\Command;
use GuzzleHttp\MessageFormatter;
use Monolog\Handler\StreamHandler;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;

class BootstrapCommand extends Command
{
    /**
     * Guzzle http client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * `.env` file path.
     *
     * @var string
     */
    protected $env;

    /**
     * Changed product flag.
     *
     * @var bool
     */
    protected $has_new_product = false;

    /**
     * Changed product key flag.
     *
     * @var bool
     */
    protected $has_new_product_key = false;

    /**
     * Changed client app ID flag.
     *
     * @var bool
     */
    protected $has_new_client_id = false;

    /**
     * Changed client app redirect URI flag.
     *
     * @var bool
     */
    protected $has_new_client_redirect_uri = false;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtn-momo:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bootstrap MTN MOMO API integration.';

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
     */
    public function handle()
    {
        // Setup guzzle client.
        $this->setUpGuzzle();

        // Set .env file path
        $this->env = $this->laravel->environmentFilePath();

        // ...............................

        $this->line('<options=bold>MTN MOMO API integration.</>'.PHP_EOL);
        $this->line('Please enter the values for the following settings,');
        $this->line("Or press 'Enter' to accept the given default values in square brackets.".PHP_EOL);

        $this->line("These settings will be written to your .env [{$this->env}]".PHP_EOL);

        // Product
        $this->setProduct();

        // Product key
        $this->setProductKey();

        // Environment
        $this->setEnvironment();

        // Currency
        $this->setCurrency();

        // Client App Name
        $this->setClientName();

        // Client app redirect URI
        $this->setClientRedirectUri();

        if ($this->has_new_product_key || $this->has_new_client_redirect_uri) {
            if ($this->confirm("Do you wish to generate a new 'client app ID'?", true)) {
                // Client app ID
                $this->setClientId();
            }
        }
    }

    /**
     * Determine replacement regex pattern for setting.
     *
     * @param  string $name Env name
     * @param  string $key Composite config name
     * @return string        Regex pattern
     */
    protected function getRegex($name, $key)
    {
        $escaped = preg_quote($this->laravel['config']->get($key), '/');

        return "/^{$name}=[\"']?{$escaped}[\"']?/m";
    }

    /**
     * Write | replace seeting in .env file.
     *
     * @param  string $value [description]
     * @return void
     */
    protected function updateSetting($name, $key, $value)
    {
        $pattern = $this->getRegex($name, $key);

        if (preg_match($pattern, file_get_contents($this->env))) {
            file_put_contents($this->env, preg_replace($pattern, "{$name}=\"{$value}\"", file_get_contents($this->env)));
        } else {
            $setting = "\r\n{$name}=\"{$value}\"\r\n";

            file_put_contents($this->env, file_get_contents($this->env).$setting);
        }

        // Update in memory.
        $this->laravel['config']->set([$key => $value]);
    }

    /**
     * Setup guzzle client.
     *
     * return void
     */
    protected function setUpGuzzle()
    {
        $stack = HandlerStack::create();

        $logger = new Logger('Logger');
        $logger->pushHandler(new StreamHandler(storage_path('logs/mtn-momo.log')), Logger::DEBUG);

        $stack->push(Middleware::log($logger, new MessageFormatter("\r\n[Request] >>>>> {request}. [Response] >>>>> \r\n{response}.")));

        $this->client = new Client([
            'debug' => false,
            'handler' => $stack,
            'progress' => function () {
                echo '* ';
            },
            'base_uri' => $this->laravel['config']->get('mtn-momo.uri.base'),
        ]);
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
            $uuid = $this->laravel['config']['mtn-momo.client.id'];
        }

        $patterns[] = '/\b[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}\b/';
        $replacements[] = $uuid;

        $patterns[] = '/(?<!:)(\/\/)/';
        $replacements[] = "/{$uuid}/";

        return preg_replace($patterns, $replacements, $uri);
    }

    /*
    |--------------------------------------------------------------------------
    | MOMO_CLIENT_NAME
    |--------------------------------------------------------------------------
    */

    /**
     * Set/replace client app name.
     *
     * @return void
     */
    protected function setClientName()
    {
        $this->line('<options=bold>Client app name.</>');
        $this->line('This could be indicated in the message sent to the payee.');

        $client_name = $this->laravel['config']->get('mtn-momo.client.name');
        $client_name = $this->ask('MOMO_CLIENT_NAME', $client_name);

        $this->updateSetting('MOMO_CLIENT_NAME', 'mtn-momo.client.name', $client_name);
    }

    /*
    |--------------------------------------------------------------------------
    | MOMO_CURRENCY
    |--------------------------------------------------------------------------
    */

    /**
     * Set/replace currency.
     *
     * @return void
     */
    protected function setCurrency()
    {
        $this->line('<options=bold>Currency.</>');
        $this->line("The currency to be used for transactions. Use 'EUR' for sandbox env.");

        $currency = $this->laravel['config']->get('mtn-momo.currency');
        $currency = strtoupper($this->ask('MOMO_CURRENCY', $currency));

        $this->updateSetting('MOMO_CURRENCY', 'mtn-momo.currency', $currency);
    }

    /*
    |--------------------------------------------------------------------------
    | MOMO_ENVIRONMENT
    |--------------------------------------------------------------------------
    */

    /**
     * Set/replace target environment.
     *
     * @return void
     */
    protected function setEnvironment()
    {
        $this->line('<options=bold>Environment.</>');
        $this->line("The environment your testing your application. Also called: 'targetEnvironment'");

        $environment = $this->laravel['config']->get('mtn-momo.environment');
        $environments = ['sandbox', 'live'];
        $index = array_search($environment, $environments);
        $default = ($index === false) ? null : $index;
        $environment = $this->choice('MOMO_ENVIRONMENT', $environments, $default);

        $this->updateSetting('MOMO_ENVIRONMENT', 'mtn-momo.environment', $environment);
    }

    /*
    |--------------------------------------------------------------------------
    | MOMO_PRODUCT
    |--------------------------------------------------------------------------
    */

    /**
     * Set/replace target product subscribed too.
     *
     * @return void
     */
    protected function setProduct()
    {
        $this->line('<options=bold>Product.</>');
        $this->line('The product you subscribed too.');

        $product = $this->laravel['config']->get('mtn-momo.product');
        $products = ['collection', 'disbursement', 'remittance'];
        $index = array_search($product, $products);
        $default = ($index === false) ? null : $index;
        $new_product = $this->choice('MOMO_PRODUCT', $products, $default);

        $this->updateSetting('MOMO_PRODUCT', 'mtn-momo.product', $new_product);

        // Has the product changed?
        $this->has_new_product = ($product == $new_product);
    }

    /*
    |--------------------------------------------------------------------------
    | MOMO_PRODUCT_KEY
    |--------------------------------------------------------------------------
    */

    /**
     * Set/replace product subscription key.
     *
     * @return void
     */
    protected function setProductKey()
    {
        $this->line('<options=bold>Product key.</>');
        $this->line("Product subscription key. Also called: 'Ocp-Apim-Subscription-Key'.");

        if (! $this->has_new_product && ! $this->confirm("Do you wish to change the 'product_key'?", true)) {
            return;
        }

        $product_key = $this->laravel['config']->get('mtn-momo.product_key');
        $new_product_key = $this->ask('MOMO_PRODUCT_KEY', $product_key);

        $this->updateSetting('MOMO_PRODUCT_KEY', 'mtn-momo.product_key', $new_product_key);

        // Has the product key changed?
        $this->has_new_product_key = ($product_key != $new_product_key);
    }

    /*
    |--------------------------------------------------------------------------
    | MOMO_CLIENT_ID
    |--------------------------------------------------------------------------
    */

    /**
     * Set/replace client app ID.
     *
     * @return void
     */
    protected function setClientId()
    {
        $this->line('<options=bold>Client app ID.</>');
        $this->line('Also called; X-Reference-Id and api_user_id interchangeably.');

        $default = $client_id = $this->laravel['config']->get('mtn-momo.client.id');

        if ($this->has_new_product_key || $this->has_new_client_redirect_uri || ! $default) {
            $this->line('* Generating new client ID...');
            $default = Uuid::uuid4()->toString();
        }

        $new_client_id = $this->ask('MOMO_CLIENT_ID', $default);

        while (! Uuid::isValid($new_client_id)) {
            $this->info(' Invalid UUID (Format: 4). #IETF RFC4122');
            $new_client_id = $this->ask('MOMO_CLIENT_ID');
        }

        $this->updateSetting('MOMO_CLIENT_ID', 'mtn-momo.client.id', $new_client_id);

        $this->has_new_client_id = ($client_id != $new_client_id);

        if ($this->has_new_client_id && $this->confirm("Do you wish to register the new 'client_id'?", true)) {
            // Register client app ID
            $this->registerClientId();
        }
    }

    /*
    |--------------------------------------------------------------------------
    | MOMO_CLIENT_REDIRECT_URI
    |--------------------------------------------------------------------------
    */

    /**
     * Set/replace the client app redirect URI.
     *
     * @return void
     */
    protected function setClientRedirectUri()
    {
        $this->line('<options=bold>Client app redirect URI.</>');
        $this->line('Also called; providerCallbackHost.');

        $redirect_uri = $this->laravel['config']->get('mtn-momo.client.redirect_uri');

        $new_redirect_uri = $redirect_uri ? $redirect_uri : false;

        $new_redirect_uri = $this->ask('MOMO_CLIENT_REDIRECT_URI', $redirect_uri);

        while ($new_redirect_uri && ! filter_var($new_redirect_uri, FILTER_VALIDATE_URL)) {
            $this->info(' Invalid URI. #IETF RFC3986');
            $new_redirect_uri = $this->ask('MOMO_CLIENT_REDIRECT_URI', false);
        }

        $this->updateSetting('MOMO_CLIENT_REDIRECT_URI', 'mtn-momo.client.redirect_uri', $new_redirect_uri);

        $this->has_new_client_redirect_uri = ($redirect_uri != $new_redirect_uri);
    }

    /*
    |--------------------------------------------------------------------------
    | MOMO_CLIENT_ID - Registration
    |--------------------------------------------------------------------------
    */

    /**
     * Regitster client app ID.
     *
     * @return void
     */
    protected function registerClientId()
    {
        $this->line('<options=bold>Register -> Client app ID.</>');
        $this->line('The client app ID has to be registered with MOMO API.');
        $this->line('It\'s required to generate a <options=bold>Client app secret</>.');

        try {
            $response = $this->client->request('POST', $this->laravel['config']->get('mtn-momo.uri.client_id'), [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Ocp-Apim-Subscription-Key' => $this->laravel['config']->get('mtn-momo.product_key'),
                    'X-Reference-Id' => $this->laravel['config']->get('mtn-momo.client.id'),
                ],
                'json' => [
                    'providerCallbackHost' => $this->laravel['config']->get('mtn-momo.client.redirect_uri'),
                ],
            ]);

            $this->line("\r\nStatus: <fg=green>".$response->getStatusCode().' '.$response->getReasonPhrase().'</>');

            $this->line("\r\nBody: <fg=green>".$response->getBody()."\r\n</>");

            if ($this->confirm("Do you wish to register the request for new 'client_secret'?", true)) {
                // Request client app Secret
                $this->requestClientSecret();
            }
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

    /*
    |--------------------------------------------------------------------------
    | Request MOMO_CLIENT_SECRET
    |--------------------------------------------------------------------------
    */

    /**
     * Request client secret.
     *
     * @return void
     */
    protected function requestClientSecret()
    {
        $this->line('<options=bold>Request -> Client APP secret.</>');
        $this->line("Also called; 'apiKey'.");

        $client_secret_uri = $this->laravel['config']->get('mtn-momo.uri.client_secret');

        try {
            $response = $this->client->request('POST', $this->cleanUri($client_secret_uri), [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Ocp-Apim-Subscription-Key' => $this->laravel['config']->get('mtn-momo.product_key'),
                ],
                'json' => [
                    'body',
                ],
            ]);

            $this->line("\r\nStatus: <fg=green>".$response->getStatusCode().' '.$response->getReasonPhrase().'</>');

            $this->line("\r\nBody: <fg=green>".$response->getBody()."\r\n</>");

            $api_response = json_decode($response->getBody(), true);

            $client_secret = $api_response['apiKey'];

            $this->updateSetting('MOMO_CLIENT_SECRET', 'mtn-momo.client.secret', $client_secret);
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
