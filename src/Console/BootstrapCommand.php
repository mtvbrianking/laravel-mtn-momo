<?php

namespace Bmatovu\MtnMomo\Console;

use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid;

class BootstrapCommand extends Command
{
    protected $dotenv;

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
    protected $description = 'Bootstrap MTN momo API integration.';

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
        $this->line('<options=bold>Welcome to MTN momo bootstrap.</>'.PHP_EOL);

        $this->line('Please enter the values for the following settings,');
        $this->line("Or press 'Enter' to accept the given default values in square brackets.".PHP_EOL);

        $this->dotenv = $this->laravel->environmentFilePath();

        $this->line("These settings will be written to your .env [{$this->dotenv}]".PHP_EOL);

        // Client App Name
        // $this->envSetAppName();

        // Currency
        // $this->envSetCurrency();

        // Environment
        // $this->envSetEnvironment();

        // Product
        // $this->envSetProduct();

        // Product Key
        // $this->envSetProductKey();

        // Client App ID
        // $this->envSetAppId();
    }

    /*
    |--------------------------------------------------------------------------
    | Momo API application name.
    |--------------------------------------------------------------------------
    */

    /**
     * Set the momo client app name in the environment file.
     *
     * @return void
     */
    protected function envSetAppName()
    {
        $this->line('<options=bold>Momo API client application name.</>');
        $this->line('This could be indicated in the message sent to the payee.');
        $app_name = $this->laravel['config']['mtn-momo.app'];
        $app_name = $this->ask('MOMO_APP_NAME', $app_name);

        $pattern = $this->regexAppNameReplacementPattern();

        if (preg_match($pattern, file_get_contents($this->dotenv))) {
            file_put_contents($this->dotenv, preg_replace(
                $this->regexAppNameReplacementPattern(),
                "MOMO_APP_NAME=\"{$app_name}\"",
                file_get_contents($this->dotenv)
            ));
        } else {
            $app_name = "\r\nMOMO_APP_NAME=\"{$app_name}\"\r\n";

            file_put_contents($this->dotenv, file_get_contents($this->dotenv).$app_name);
        }
    }

    /**
     * Get a regex pattern that will match env MOMO_APP_NAME with any random name.
     *
     * @return string
     */
    protected function regexAppNameReplacementPattern()
    {
        $escaped = preg_quote($this->laravel['config']['mtn-momo.app'], '/');

        return "/^MOMO_APP_NAME=[\"']?{$escaped}[\"']?/m";
    }

    /*
    |--------------------------------------------------------------------------
    | Transaction currency code.
    |--------------------------------------------------------------------------
    */

    /**
     * Set the momo client app name in the environment file.
     *
     * @return void
     */
    protected function envSetCurrency()
    {
        $this->line('<options=bold>Momo API client application currency.</>');
        $this->line("The currency to be used for transactions. Use 'EUR' for sandbox env.");
        $currency = $this->laravel['config']['mtn-momo.currency'];

        $currency = strtoupper($this->ask('MOMO_CURRENCY', $currency));

        $pattern = $this->regexCurrencyReplacementPattern();

        if (preg_match($pattern, file_get_contents($this->dotenv))) {
            file_put_contents($this->dotenv, preg_replace(
                $this->regexCurrencyReplacementPattern(),
                "MOMO_CURRENCY=\"{$currency}\"",
                file_get_contents($this->dotenv)
            ));
        } else {
            $currency = "\r\nMOMO_CURRENCY=\"{$currency}\"\r\n";

            file_put_contents($this->dotenv, file_get_contents($this->dotenv).$currency);
        }
    }

    /**
     * Get a regex pattern that will match env MOMO_CURRENCY with any random name.
     *
     * @return string
     */
    protected function regexCurrencyReplacementPattern()
    {
        $escaped = preg_quote($this->laravel['config']['mtn-momo.currency'], '/');

        return "/^MOMO_CURRENCY=[\"']?{$escaped}[\"']?/m";
    }

    /*
    |--------------------------------------------------------------------------
    | Target environment.
    |--------------------------------------------------------------------------
    */

    /**
     * Set the momo client app name in the environment file.
     *
     * @return void
     */
    protected function envSetEnvironment()
    {
        $this->line('<options=bold>Momo API client application environment.</>');
        $this->line("The environment your testing your application.");
        $environment = $this->laravel['config']['mtn-momo.environment'];

        $environments = ['sandbox', 'live'];
        $index = array_search($environment, $environments);
        $default = ($index === false) ? null : $index;
        $environment = $this->choice('MOMO_ENVIRONMENT', $environments, $default);

        $pattern = $this->regexEnvironmentReplacementPattern();

        if (preg_match($pattern, file_get_contents($this->dotenv))) {
            file_put_contents($this->dotenv, preg_replace(
                $this->regexEnvironmentReplacementPattern(),
                "MOMO_ENVIRONMENT=\"{$environment}\"",
                file_get_contents($this->dotenv)
            ));
        } else {
            $environment = "\r\nMOMO_ENVIRONMENT=\"{$environment}\"\r\n";

            file_put_contents($this->dotenv, file_get_contents($this->dotenv).$environment);
        }
    }

    /**
     * Get a regex pattern that will match env MOMO_ENVIRONMENT with any random name.
     *
     * @return string
     */
    protected function regexEnvironmentReplacementPattern()
    {
        $escaped = preg_quote($this->laravel['config']['mtn-momo.environment'], '/');

        return "/^MOMO_ENVIRONMENT=[\"']?{$escaped}[\"']?/m";
    }

    /*
    |--------------------------------------------------------------------------
    | Target environment.
    |--------------------------------------------------------------------------
    */

    /**
     * Set the momo client app name in the environment file.
     *
     * @return void
     */
    protected function envSetProduct()
    {
        $this->line('<options=bold>Momo API production.</>');
        $this->line("The product you subscribed too.");
        $product = $this->laravel['config']['mtn-momo.product'];

        $products = ['collections', 'disbursement', 'remittance'];
        $index = array_search($product, $products);
        $default = ($index === false) ? null : $index;
        $product = $this->choice('MOMO_PRODUCT', $products, $default);

        $pattern = $this->regexProductReplacementPattern();

        if (preg_match($pattern, file_get_contents($this->dotenv))) {
            file_put_contents($this->dotenv, preg_replace(
                $this->regexProductReplacementPattern(),
                "MOMO_PRODUCT=\"{$product}\"",
                file_get_contents($this->dotenv)
            ));
        } else {
            $product = "\r\nMOMO_PRODUCT=\"{$product}\"\r\n";

            file_put_contents($this->dotenv, file_get_contents($this->dotenv).$product);
        }
    }

    /**
     * Get a regex pattern that will match env MOMO_PRODUCT with any random name.
     *
     * @return string
     */
    protected function regexProductReplacementPattern()
    {
        $escaped = preg_quote($this->laravel['config']['mtn-momo.product'], '/');

        return "/^MOMO_PRODUCT=[\"']?{$escaped}[\"']?/m";
    }

    /*
    |--------------------------------------------------------------------------
    | MOMO_PRODUCT_KEY
    |--------------------------------------------------------------------------
    */

    /**
     * Set the momo product subscription key in the environment file.
     *
     * @return void
     */
    protected function envSetProductKey()
    {
        $this->line('<options=bold>Momo product key.</>');
        $this->line("Product subscription key. Also called: 'Ocp-Apim-Subscription-Key'.");
        $product_key = $this->laravel['config']['mtn-momo.product_key'];
        $product_key = $this->ask('MOMO_PRODUCT_KEY', $product_key);

        $pattern = $this->regexProductKeyReplacementPattern();

        if (preg_match($pattern, file_get_contents($this->dotenv))) {
            file_put_contents($this->dotenv, preg_replace(
                $this->regexProductKeyReplacementPattern(),
                "MOMO_PRODUCT_KEY=\"{$product_key}\"",
                file_get_contents($this->dotenv)
            ));
        } else {
            $product_key = "\r\nMOMO_PRODUCT_KEY=\"{$product_key}\"\r\n";

            file_put_contents($this->dotenv, file_get_contents($this->dotenv).$product_key);
        }
    }

    /**
     * Get a regex pattern that will match env MOMO_PRODUCT_KEY with any random name.
     *
     * @return string
     */
    protected function regexProductKeyReplacementPattern()
    {
        $escaped = preg_quote($this->laravel['config']['mtn-momo.product_key'], '/');

        return "/^MOMO_PRODUCT_KEY=[\"']?{$escaped}[\"']?/m";
    }

    /*
    |--------------------------------------------------------------------------
    | MOMO_CLIENT_ID
    |--------------------------------------------------------------------------
    */

    /**
     * Set the momo client app ID.
     *
     * @return void
     */
    protected function envSetAppId()
    {
        $this->line('<options=bold>Momo client app ID.</>');
        $this->line("Also called; X-Reference-Id and api_user_id interchangeably.");
        $client_id = $this->laravel['config']['mtn-momo.client_id'];

        $client_id = $this->ask('MOMO_CLIENT_ID', $client_id);

        while(!Uuid::isValid($client_id)) {
            $this->info(' Client ID must be a UUID of format 4. #IETF RFC4122');
            $client_id = $this->ask('MOMO_CLIENT_ID');
        }

        $pattern = $this->regexAppIdReplacementPattern();

        if (preg_match($pattern, file_get_contents($this->dotenv))) {
            file_put_contents($this->dotenv, preg_replace(
                $this->regexAppIdReplacementPattern(),
                "MOMO_CLIENT_ID=\"{$client_id}\"",
                file_get_contents($this->dotenv)
            ));
        } else {
            $client_id = "\r\nMOMO_CLIENT_ID=\"{$client_id}\"\r\n";

            file_put_contents($this->dotenv, file_get_contents($this->dotenv).$client_id);
        }
    }

    /**
     * Get a regex pattern that will match env MOMO_CLIENT_ID with any random name.
     *
     * @return string
     */
    protected function regexAppIdReplacementPattern()
    {
        $escaped = preg_quote($this->laravel['config']['mtn-momo.client_id'], '/');

        return "/^MOMO_CLIENT_ID=[\"']?{$escaped}[\"']?/m";
    }

}
