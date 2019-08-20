<?php
/**
 * CommandUtilTrait.
 */

namespace Bmatovu\MtnMomo\Traits;

/**
 * Console commands utilities.
 */
trait CommandUtilTrait
{
    /**
     * Warn user running command in production.
     *
     * @param  string $warning
     *
     * @return bool
     */
    protected function runInProduction($warning = 'Application In Production!')
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
     *
     * @return void
     */
    protected function printLabels($title, $body = null)
    {
        $this->line("<options=bold>{$title}</>");

        if (is_null($body)) {
            return;
        }

        $body = is_array($body) ? $body : [$body];

        foreach ($body as $content) {
            $this->line("{$content}");
        }

        $this->output->writeln('');
    }

    /**
     * Determine replacement regex pattern a setting.
     *
     * @deprecated 1.3 No longer used.
     *
     * @param  string $name ENV_VALUE, like; `APP_NAME`
     * @param  string $key Compose setting name, like `app.name`
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
     * @param  string $name ENV_VALUE, like; `APP_NAME`
     * @param  string $key Compose setting name, like `app.name`
     * @param  string $value Setting value
     *
     * @return void
     */
    protected function updateSetting($name, $key, $value)
    {
        // Update in memory.
        $this->laravel['config']->set([$key => $value]);

        if ($this->option('no-write')) {
            return;
        }

        // Update in file.
        $env = $this->laravel->environmentFilePath();

        $name = strtoupper($name);

        $pattern = "/^{$name}=[\"']?.*/m";

        if (preg_match($pattern, file_get_contents($env))) {
            file_put_contents($env, preg_replace($pattern, "{$name}=\"{$value}\"", file_get_contents($env)));
        } else {
            $setting = "\r\n{$name}=\"{$value}\"\r\n";
            file_put_contents($env, file_get_contents($env).$setting);
        }
    }
}
