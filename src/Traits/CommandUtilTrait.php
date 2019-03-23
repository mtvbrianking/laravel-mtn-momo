<?php

namespace Bmatovu\MtnMomo\Traits;

use Closure;
use Monolog\Logger;
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use Monolog\Handler\StreamHandler;

trait CommandUtilTrait
{
    /**
     * Confirm to run command in production.
     *
     * @param  string $warning
     *
     * @return bool
     */
    public function runInProduction($warning = 'Application In Production!')
    {
        if ($this->getLaravel()->environment() != 'production') {
            return true;
        }

        if ($this->option('force')) {
            return true;
        }

        $this->comment(str_repeat('*', strlen($warning) + 12));
        $this->comment('*     '.$warning.'     *');
        $this->comment(str_repeat('*', strlen($warning) + 12));
        $this->output->writeln('');

        $confirmed = $this->confirm('Do you really wish to proceed?');

        if (! $confirmed) {
            $this->comment('Command Cancelled!');

            return false;
        }

        return true;
    }

    /**
     * Print formatted labels.
     *
     * @param  string  $title
     * @param  array|string  $body
     * @param  int $length
     *
     * @return void
     */
    protected function printLabels($title, $body = null, $length = 74)
    {
        $this->line('|'.str_repeat('-', $length));
        $this->line("| {$title}");
        $this->line('|'.str_repeat('-', $length));

        if (is_null($body)) {
            return;
        }

        $body = is_array($body) ? $body : [$body];

        foreach ($body as $content) {
            $this->line("| {$content}");
        }

        $this->output->writeln('');
    }

    /**
     * Setup guzzle client.
     *
     * @param \Closure|null $progress
     * @param bool|false $debug
     *
     * @return \GuzzleHttp\Client
     * @throws \Exception
     */
    protected function prepareGuzzle(Closure $progress = null, $debug = false)
    {
        $stack = HandlerStack::create();

        if ($debug) {
            $logger = $this->laravel['log']->getMonolog(); // new Logger('Logger');
            $logger->pushHandler(new StreamHandler(storage_path('logs/mtn-momo.log')), Logger::DEBUG);
            $stack->push(Middleware::log($logger, new MessageFormatter(MessageFormatter::DEBUG)));
            // $stack->push(Middleware::log($logger, new MessageFormatter("\r\n[Request] >>>>> {request}. [Response] >>>>> \r\n{response}.")));
        }

        return new Client([
            'handler' => $stack,
            'progress' => $progress,
            'base_uri' => $this->laravel['config']->get('mtn-momo.uri.base'),
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Ocp-Apim-Subscription-Key' => $this->laravel['config']->get('mtn-momo.product_key'),
            ],
            'json' => [
                'body',
            ],
        ]);
    }

    /**
     * Determine replacement regex pattern a setting.
     *
     * @param  string $name Env name
     * @param  string $key Composite config name
     *
     * @return string        Regex pattern
     */
    protected function getRegex($name, $key)
    {
        $escaped = preg_quote($this->laravel['config']->get($key), '/');

        return "/^{$name}=[\"']?{$escaped}[\"']?/m";
    }

    /**
     * Write | replace setting in .env file.
     *
     * @param  string $value
     *
     * @return void
     */
    protected function updateSetting($name, $key, $value)
    {
        $env = $this->laravel->environmentFilePath();

        $pattern = $this->getRegex($name, $key);

        if (preg_match($pattern, file_get_contents($env))) {
            file_put_contents($env, preg_replace($pattern, "{$name}=\"{$value}\"", file_get_contents($env)));
        } else {
            $setting = "\r\n{$name}=\"{$value}\"\r\n";
            file_put_contents($env, file_get_contents($env).$setting);
        }

        // Update in memory.
        $this->laravel['config']->set([$key => $value]);
    }
}
