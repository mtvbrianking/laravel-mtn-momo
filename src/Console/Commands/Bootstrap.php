<?php

namespace Bmatovu\MtnMomo\Console\Commands;

use Illuminate\Console\Command;

class Bootstrap extends Command
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
        $this->line("<options=bold>Welcome to MTN momo bootstrap.</>".PHP_EOL);

        $this->line("Please enter the values for the following settings,");
        $this->line("Or press 'Enter' to accept the given default values in square brackets.".PHP_EOL);

        $this->dotenv = $this->laravel->environmentFilePath();

        $this->line("These settings will be written to your .env [{$this->dotenv}]".PHP_EOL);

        // App name
        $this->envSetAppName();

    }

    /**
     * Set the momo client app name in the environment file.
     *
     * @return void
     */
    protected function envSetAppName()
    {
        $this->line("<options=bold>Momo API client application name.</>");
        $this->line("This could be indicated in the message sent to the payee.");
        $app_name = $this->laravel['config']['mtn-momo.app'];
        $app_name = $this->ask("MOMO_APP_NAME", $app_name);

        $pattern = $this->keyAppNameReplacementPattern();

        if (preg_match($pattern, file_get_contents($this->dotenv))) {
            file_put_contents($this->dotenv, preg_replace(
                $this->keyAppNameReplacementPattern(),
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
    protected function keyAppNameReplacementPattern()
    {
        $escaped = preg_quote($this->laravel['config']['mtn-momo.app'], '/');

        return "/^MOMO_APP_NAME=[\"']?{$escaped}[\"']?/m";
    }
}
