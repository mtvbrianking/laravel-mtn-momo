<?php

namespace Bmatovu\MtnMomo\Console;

use Ramsey\Uuid\Uuid;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Console\Command;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;

class BootstrapCommand extends Command
{
    protected $env;

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
        $this->line('<options=bold>MTN MOMO API integration.</>'.PHP_EOL);

        $this->line('Please enter the values for the following settings,');
        $this->line("Or press 'Enter' to accept the given default values in square brackets.".PHP_EOL);

        $this->env = $this->laravel->environmentFilePath();

        $this->line("These settings will be written to your .env [{$this->env}]".PHP_EOL);

        // // Client App Name
        // $this->setClientName();

        // // Currency
        // $this->setCurrency();

        // // Environment
        // $this->setEnvironment();

        // // Product
        // $this->setProduct();

        // // Product key
        // $this->setProductKey();

        // // Client app ID
        // $this->setClientId();

        // // Client app redirect URI
        // $this->setClientRedirectUri();

        // // Register client app ID
        // $this->registerClientId();

        // // Request client app Secret
        // $this->requestClientSecret();

    }

    /**
     * Get the specified configuration value.
     *
     * @param  string  $setting
     * @param  mixed  $default
     * @return mixed
     */
    private function config($setting, $default = null)
    {
        return Arr::get($this->laravel['config'], $setting, $default);
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
        $client_name = $this->config('mtn-momo.client.name');
        $client_name = $this->ask('MOMO_CLIENT_NAME', $client_name);

        $pattern = $this->getClientNameRegex();

        if (preg_match($pattern, file_get_contents($this->env))) {
            file_put_contents($this->env, preg_replace(
                $this->getClientNameRegex(),
                "MOMO_CLIENT_NAME=\"{$client_name}\"",
                file_get_contents($this->env)
            ));
        } else {
            $client_name = "\r\nMOMO_CLIENT_NAME=\"{$client_name}\"\r\n";

            file_put_contents($this->env, file_get_contents($this->env).$client_name);
        }
    }

    /**
     * Determine client app name regex pattern.
     *
     * @return string Regex
     */
    protected function getClientNameRegex()
    {
        $escaped = preg_quote($this->config('mtn-momo.client.name'), '/');

        return "/^MOMO_CLIENT_NAME=[\"']?{$escaped}[\"']?/m";
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
        $currency = $this->config('mtn-momo.currency');

        $currency = strtoupper($this->ask('MOMO_CURRENCY', $currency));

        $pattern = $this->getCurrencyRegex();

        if (preg_match($pattern, file_get_contents($this->env))) {
            file_put_contents($this->env, preg_replace(
                $this->getCurrencyRegex(),
                "MOMO_CURRENCY=\"{$currency}\"",
                file_get_contents($this->env)
            ));
        } else {
            $currency = "\r\nMOMO_CURRENCY=\"{$currency}\"\r\n";

            file_put_contents($this->env, file_get_contents($this->env).$currency);
        }
    }

    /**
     * Get a regex pattern that will match env MOMO_CURRENCY with any random name.
     *
     * @return string
     */
    protected function getCurrencyRegex()
    {
        $escaped = preg_quote($this->config('mtn-momo.currency'), '/');

        return "/^MOMO_CURRENCY=[\"']?{$escaped}[\"']?/m";
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
        $environment = $this->config('mtn-momo.environment');

        $environments = ['sandbox', 'live'];
        $index = array_search($environment, $environments);
        $default = ($index === false) ? null : $index;
        $environment = $this->choice('MOMO_ENVIRONMENT', $environments, $default);

        $pattern = $this->getEnvironmentRegex();

        if (preg_match($pattern, file_get_contents($this->env))) {
            file_put_contents($this->env, preg_replace(
                $this->getEnvironmentRegex(),
                "MOMO_ENVIRONMENT=\"{$environment}\"",
                file_get_contents($this->env)
            ));
        } else {
            $environment = "\r\nMOMO_ENVIRONMENT=\"{$environment}\"\r\n";

            file_put_contents($this->env, file_get_contents($this->env).$environment);
        }
    }

    /**
     * Get a regex pattern that will match env MOMO_ENVIRONMENT with any random name.
     *
     * @return string
     */
    protected function getEnvironmentRegex()
    {
        $escaped = preg_quote($this->config('mtn-momo.environment'), '/');

        return "/^MOMO_ENVIRONMENT=[\"']?{$escaped}[\"']?/m";
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
        $this->line("The product you subscribed too.");
        $product = $this->config('mtn-momo.product');

        $products = ['collections', 'disbursement', 'remittance'];
        $index = array_search($product, $products);
        $default = ($index === false) ? null : $index;
        $product = $this->choice('MOMO_PRODUCT', $products, $default);

        $pattern = $this->getProductRegex();

        if (preg_match($pattern, file_get_contents($this->env))) {
            file_put_contents($this->env, preg_replace(
                $this->getProductRegex(),
                "MOMO_PRODUCT=\"{$product}\"",
                file_get_contents($this->env)
            ));
        } else {
            $product = "\r\nMOMO_PRODUCT=\"{$product}\"\r\n";

            file_put_contents($this->env, file_get_contents($this->env).$product);
        }
    }

    /**
     * Get a regex pattern that will match env MOMO_PRODUCT with any random name.
     *
     * @return string
     */
    protected function getProductRegex()
    {
        $escaped = preg_quote($this->config('mtn-momo.product'), '/');

        return "/^MOMO_PRODUCT=[\"']?{$escaped}[\"']?/m";
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
        $product_key = $this->config('mtn-momo.product_key');
        $product_key = $this->ask('MOMO_PRODUCT_KEY', $product_key);

        $pattern = $this->getProductKeyRegex();

        if (preg_match($pattern, file_get_contents($this->env))) {
            file_put_contents($this->env, preg_replace(
                $this->getProductKeyRegex(),
                "MOMO_PRODUCT_KEY=\"{$product_key}\"",
                file_get_contents($this->env)
            ));
        } else {
            $product_key = "\r\nMOMO_PRODUCT_KEY=\"{$product_key}\"\r\n";

            file_put_contents($this->env, file_get_contents($this->env).$product_key);
        }
    }

    /**
     * Get a regex pattern that will match env MOMO_PRODUCT_KEY with any random name.
     *
     * @return string
     */
    protected function getProductKeyRegex()
    {
        $escaped = preg_quote($this->config('mtn-momo.product_key'), '/');

        return "/^MOMO_PRODUCT_KEY=[\"']?{$escaped}[\"']?/m";
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
        $client_id = $this->config('mtn-momo.client.id');

        if (! $client_id) {
            $this->line('Generating random UUID.');
            $client_id = uuid4()->toString();
        }

        $client_id = $this->ask('MOMO_CLIENT_ID', $client_id);

        while (! Uuid::isValid($client_id)) {
            $this->info(' Invalid UUID (Format: 4). #IETF RFC4122');
            $client_id = $this->ask('MOMO_CLIENT_ID');
        }

        $pattern = $this->getClientIdRegex();

        if (preg_match($pattern, file_get_contents($this->env))) {
            file_put_contents($this->env, preg_replace(
                $this->getClientIdRegex(),
                "MOMO_CLIENT_ID=\"{$client_id}\"",
                file_get_contents($this->env)
            ));
        } else {
            $client_id = "\r\nMOMO_CLIENT_ID=\"{$client_id}\"\r\n";

            file_put_contents($this->env, file_get_contents($this->env).$client_id);
        }
    }

    /**
     * Get a regex pattern that will match env MOMO_CLIENT_ID with any random name.
     *
     * @return string
     */
    protected function getClientIdRegex()
    {
        $escaped = preg_quote($this->config('mtn-momo.client.id'), '/');

        return "/^MOMO_CLIENT_ID=[\"']?{$escaped}[\"']?/m";
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
        $redirect_uri = $this->config('mtn-momo.client.redirect_uri');

        $redirect_uri = $this->ask('MOMO_CLIENT_REDIRECT_URI', $redirect_uri);

        while ($redirect_uri && ! filter_var($redirect_uri, FILTER_VALIDATE_URL)) {
            $this->info(' Invalid URI. #IETF RFC3986');
            $redirect_uri = $this->ask('MOMO_CLIENT_REDIRECT_URI', false);
        }

        $pattern = $this->getClientRedirectUriRegex();

        if (preg_match($pattern, file_get_contents($this->env))) {
            file_put_contents($this->env, preg_replace(
                $this->getClientRedirectUriRegex(),
                "MOMO_CLIENT_REDIRECT_URI=\"{$redirect_uri}\"",
                file_get_contents($this->env)
            ));
        } else {
            $redirect_uri = "\r\nMOMO_CLIENT_REDIRECT_URI=\"{$redirect_uri}\"\r\n";

            file_put_contents($this->env, file_get_contents($this->env).$redirect_uri);
        }
    }

    /**
     * Get a regex pattern that will match env MOMO_CLIENT_REDIRECT_URI with any random name.
     *
     * @return string
     */
    protected function getClientRedirectUriRegex()
    {
        $escaped = preg_quote($this->config('mtn-momo.client.redirect_uri'), '/');

        return "/^MOMO_CLIENT_REDIRECT_URI=[\"']?{$escaped}[\"']?/m";
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
            $client = new Client(['base_uri' => 'https://ericssonbasicapi2.azure-api.net/']);

            $response = $client->request('POST', 'v1_0/apiuser', [
                'debug' => false,
                'progress' => function () {
                    echo '* ';
                },
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Ocp-Apim-Subscription-Key' => $this->config('mtn-momo.product_key'),
                    'X-Reference-Id' => $this->config('mtn-momo.client.id'),
                ],
                'json' => [
                    'providerCallbackHost' => $this->config('mtn-momo.client.redirect_uri'),
                ],
            ]);

            $this->line("\r\nStatus: <fg=green>".$response->getStatusCode().' '.$response->getReasonPhrase().'</>');

            $this->line("\r\nBody: <fg=green>".$response->getBody().'</>');
        } catch (ConnectException $ex) {
            $this->line("\r\n<fg=red>".$ex->getMessage().'</>');
        } catch (ClientException $ex) {
            $response = $ex->getResponse();
            $this->line("\r\nStatus: <fg=yellow>".$response->getStatusCode().' '.$response->getReasonPhrase().'</>');
            $this->line("\r\nBody: <fg=yellow>".$response->getBody().'</>');
        } catch (ServerException $ex) {
            $response = $ex->getResponse();
            $this->line("\r\nStatus: <fg=red>".$response->getStatusCode().' '.$response->getReasonPhrase().'</>');
            $this->line("\r\nBody: <fg=red>".$response->getBody().'</>');
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

        $client_secret = $this->config('mtn-momo.client.secret');

        if($client_secret) {
            if (!$this->confirm('Do you wish to refresh the client app secret?')) {
                return;
            }
        }

        try {
            $client = new Client(['base_uri' => 'https://ericssonbasicapi2.azure-api.net/']);

            $response = $client->request('POST', $this->config('mtn-momo.uri.client_secret'), [
                'debug' => false,
                'progress' => function () {
                    echo '* ';
                },
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Ocp-Apim-Subscription-Key' => $this->config('mtn-momo.product_key'),
                ],
                'json' => [
                    'body',
                ],
            ]);

            $this->line("\r\nStatus: <fg=green>".$response->getStatusCode().' '.$response->getReasonPhrase().'</>');

            $this->line("\r\nBody: <fg=green>".$response->getBody().'</>');

            $api_response = json_decode($response->getBody(), true);

            $client_secret = $api_response['apiKey'];

            $pattern = $this->getClientSecretRegex();

            if (preg_match($pattern, file_get_contents($this->env))) {
                file_put_contents($this->env, preg_replace(
                    $this->getClientSecretRegex(),
                    "MOMO_CLIENT_SECRET=\"{$client_secret}\"",
                    file_get_contents($this->env)
                ));
            } else {
                $client_secret = "\r\nMOMO_CLIENT_SECRET=\"{$client_secret}\"\r\n";

                file_put_contents($this->env, file_get_contents($this->env).$client_secret);
            }

        } catch (ConnectException $ex) {
            $this->line("\r\n<fg=red>".$ex->getMessage().'</>');
        } catch (ClientException $ex) {
            $response = $ex->getResponse();
            $this->line("\r\nStatus: <fg=yellow>".$response->getStatusCode().' '.$response->getReasonPhrase().'</>');
            $this->line("\r\nBody: <fg=yellow>".$response->getBody().'</>');
        } catch (ServerException $ex) {
            $response = $ex->getResponse();
            $this->line("\r\nStatus: <fg=red>".$response->getStatusCode().' '.$response->getReasonPhrase().'</>');
            $this->line("\r\nBody: <fg=red>".$response->getBody().'</>');
        }
    }

    /**
     * Get a regex pattern that will match env MOMO_CLIENT_SECRET with any random name.
     *
     * @return string
     */
    protected function getClientSecretRegex()
    {
        $escaped = preg_quote($this->config('mtn-momo.client.secret'), '/');

        return "/^MOMO_CLIENT_SECRET=[\"']?{$escaped}[\"']?/m";
    }
}
