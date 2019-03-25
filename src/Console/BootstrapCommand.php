<?php
/**
 * BootstrapCommand.php.
 */

namespace Bmatovu\MtnMomo\Console;

use Ramsey\Uuid\Uuid;
use Illuminate\Console\Command;
use Bmatovu\MtnMomo\Traits\CommandUtilTrait;

/**
 * Class BootstrapCommand.
 */
class BootstrapCommand extends Command
{
    use CommandUtilTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtn-momo:init
                                {--d|debug= : Enable debugging for http requests.}
                                {--l|log=mtn-momo.log : Debug log file.}
                                {--f|force : Force the operation to run when in production.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bootstrap/setup integration.';

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
     * @return void
     */
    public function handle()
    {
        if (! $this->runInProduction()) {
            return;
        }

        $this->printLabels('MTN MOMO API integration', [
            'Please enter the values for the following settings,',
            "Or press 'Enter' to accept the given default values in square brackets.",
            'These settings will be written to your .env',
        ]);

        // Product
        $this->setProduct();

        // Product key
        $this->setProductKey();

        // Environment
        $this->setEnvironment();

        // Currency
        $this->setCurrency();

        // Client APP name
        $this->setClientName();

        // Client APP redirect URI
        $this->setClientRedirectUri();

        // Client APP ID
        $this->setClientId();

        $this->info("\r\nComplete...");
    }

    /**
     * Create/update target product subscribed too.
     *
     * @return void
     */
    protected function setProduct()
    {
        $this->printLabels('Product');

        $product = $this->laravel['config']->get('mtn-momo.product');
        $products = ['collection', 'disbursement', 'remittance'];
        $index = array_search($product, $products);
        $default = ($index === false) ? 0 : $index;

        $product = $this->choice('MOMO_PRODUCT', $products, $default);

        $this->updateSetting('MOMO_PRODUCT', 'mtn-momo.app.product', $product);
    }

    /**
     * Create/update product subscription key.
     *
     * @return void
     */
    protected function setProductKey()
    {
        $this->printLabels('Product subscription key', [
            'Also called: <options=bold>Ocp-Apim-Subscription-Key</>.',
        ]);

        $product_key = $this->laravel['config']->get('mtn-momo.app.product_key');
        $product_key = $this->ask('MOMO_PRODUCT_KEY', $product_key);

        $this->updateSetting('MOMO_PRODUCT_KEY', 'mtn-momo.app.product_key', $product_key);
    }

    /**
     * Create/update target environment.
     *
     * @return void
     */
    protected function setEnvironment()
    {
        $this->printLabels('Environment', [
            'Also called: <options=bold>targetEnvironment</>.',
        ]);

        $environment = $this->laravel['config']->get('mtn-momo.app.environment');
        $environments = ['sandbox', 'live'];
        $index = array_search($environment, $environments);
        $default = ($index === false) ? null : $index;
        $environment = $this->choice('MOMO_ENVIRONMENT', $environments, $default);

        $this->updateSetting('MOMO_ENVIRONMENT', 'mtn-momo.app.environment', $environment);
    }

    /**
     * Create/update currency.
     *
     * @return void
     */
    protected function setCurrency()
    {
        $this->printLabels('Currency', [
            "Use 'EUR' for sandbox environment",
        ]);

        $currency = $this->laravel['config']->get('mtn-momo.app.currency');
        $currency = strtoupper($this->ask('MOMO_CURRENCY', $currency));

        $this->updateSetting('MOMO_CURRENCY', 'mtn-momo.app.currency', $currency);
    }

    /**
     * Create/update the client APP redirect URI.
     *
     * @return void
     */
    protected function setClientRedirectUri()
    {
        $this->printLabels('Client APP redirect URI', [
            'Also called; <options=bold>providerCallbackHost</> or <options=bold>X-Callback-Url</> interchangeably',
        ]);

        $redirect_uri = $this->laravel['config']->get('mtn-momo.app.redirect_uri');

        $redirect_uri = $redirect_uri ? $redirect_uri : false;

        $redirect_uri = $this->ask('MOMO_CLIENT_REDIRECT_URI', $redirect_uri);

        while ($redirect_uri && ! filter_var($redirect_uri, FILTER_VALIDATE_URL)) {
            $this->info(' Invalid URI. #IETF RFC3986');
            $redirect_uri = $this->ask('MOMO_CLIENT_REDIRECT_URI', false);
        }

        $this->updateSetting('MOMO_CLIENT_REDIRECT_URI', 'mtn-momo.app.redirect_uri', $redirect_uri);
    }

    /**
     * Create/update client APP name.
     *
     * @return void
     */
    protected function setClientName()
    {
        $this->printLabels('Client APP name', [
            'May be indicated in the message sent to the payee',
        ]);

        $client_name = $this->laravel['config']->get('mtn-momo.app.name');
        $client_name = $this->ask('MOMO_CLIENT_NAME', $client_name);

        $this->updateSetting('MOMO_CLIENT_NAME', 'mtn-momo.app.name', $client_name);
    }

    /**
     * Create/update client APP ID.
     *
     * @return void
     */
    protected function setClientId()
    {
        $this->printLabels('Client APP ID', [
            'Also called; <options=bold>X-Reference-Id</> or <options=bold>api_user_id</> interchangeably',
        ]);

        $client_id = $this->laravel['config']->get('mtn-momo.app.id');

        if (! $client_id) {
            $this->comment('> Generating new client ID...');
            $client_id = Uuid::uuid4()->toString();
        }

        $client_id = $this->ask('MOMO_CLIENT_ID', $client_id);

        while (! Uuid::isValid($client_id)) {
            $this->info(' Invalid UUID (Format: 4). #IETF RFC4122');
            $client_id = $this->ask('MOMO_CLIENT_ID');
        }

        $this->updateSetting('MOMO_CLIENT_ID', 'mtn-momo.app.id', $client_id);

        if ($this->confirm('Do you wish to register the APP ID?', true)) {
            $this->call('mtn-momo:register-id', [
                '--id' => $client_id,
                '--callback' => $this->laravel['config']->get('mtn-momo.app.redirect_uri'),
                '--force' => $this->option('force'),
                '--debug' => $this->option('debug'),
                '--log' => $this->option('log'),
            ]);
        }
    }
}
