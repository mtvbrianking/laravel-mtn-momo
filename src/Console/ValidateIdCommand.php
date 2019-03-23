<?php

namespace Bmatovu\MtnMomo\Console;

use Ramsey\Uuid\Uuid;
use Illuminate\Console\Command;
use Bmatovu\MtnMomo\Traits\CommandUtilTrait;

class ValidateIdCommand extends Command
{
    use CommandUtilTrait;

    /**
     * Guzzle http client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtn-momo:validate-id
                                {--d|debug= : Enable debugging for http requests.}
                                {--l|log=mtn-momo.log : Debug log file.}
                                {--f|force : Force the operation to run when in production.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Validate client APP ID; 'apiuser'";

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
        if (! $this->runInProduction()) {
            return;
        }

        $this->info('Todo...');
    }

}
