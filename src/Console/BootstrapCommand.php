<?php
/**
 * BootstrapCommand.
 */

namespace Bmatovu\MtnMomo\Console;

use Illuminate\Console\Command;
use Bmatovu\MtnMomo\Traits\CommandUtilTrait;

/**
 * Bootstrap integration.
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
                                {--no-write= : Don\'t credentials to .env file.}
                                {--f|force : Force the operation to run when in production.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bootstrap/setup integration.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
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

        // Client APP name
        $this->setClientName();

        // Environment
        $this->setEnvironment();

        // Currency
        $this->setCurrency();

        // Product
        $this->setProductName();

        // Product key
        $this->setProductSubscriptionKey();

        $this->info("\r\nComplete...");
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

        $client_name = $this->laravel['config']->get('mtn-momo.app');
        $client_name = $this->ask('MOMO_APP', $client_name);

        $this->updateSetting('MOMO_APP', 'mtn-momo.app', $client_name);
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

        $environment = $this->laravel['config']->get('mtn-momo.environment');
        $environments = ['sandbox', 'live'];
        $index = array_search($environment, $environments);
        $default = ($index === false) ? null : $index;
        $environment = $this->choice('MOMO_ENVIRONMENT', $environments, $default);

        $this->updateSetting('MOMO_ENVIRONMENT', 'mtn-momo.environment', $environment);
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

        $currency = $this->laravel['config']->get('mtn-momo.currency');
        $currency = $this->ask('MOMO_CURRENCY', $currency);

        $this->updateSetting('MOMO_CURRENCY', 'mtn-momo.currency', strtoupper($currency));
    }

    /**
     * Create/update target product subscribed too.
     *
     * @return void
     */
    protected function setProductName()
    {
        $this->printLabels('Product');

        $product = $this->laravel['config']->get('mtn-momo.product');
        $products = ['collection', 'disbursement', 'remittance'];
        $index = array_search($product, $products);
        $default = ($index === false) ? 0 : $index;

        $product = $this->choice('MOMO_PRODUCT', $products, $default);

        $this->updateSetting('MOMO_PRODUCT', 'mtn-momo.product', $product);
    }

    /**
     * Create/update product subscription key.
     *
     * @return void
     */
    protected function setProductSubscriptionKey()
    {
        $this->printLabels('Product subscription key', [
            'Also called: <options=bold>Ocp-Apim-Subscription-Key</>.',
        ]);

        $product = $this->laravel['config']->get('mtn-momo.product');

        $uProduct = strtoupper($product);

        $product_key = $this->laravel['config']->get("mtn-momo.products.{$product}.key");
        $product_key = $this->ask("MOMO_{$uProduct}_SUBSCRIPTION_KEY", $product_key);

        $this->updateSetting("MOMO_{$uProduct}_SUBSCRIPTION_KEY", "mtn-momo.products.{$product}.key", $product_key);
    }
}
