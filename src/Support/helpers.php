<?php

use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Illuminate\Container\Container;

if (! function_exists('environment_file_path')) {
    /**
     * Get application environment file path.
     *
     * For both Laravel and Lumen framework.
     *
     * @param string  $helper
     * @param string  $envFile
     *
     * @return string
     */
    function environment_file_path($helper = 'environmentFilePath', $envFile = '.env'): string
    {
        $app = Container::getInstance();

        if (method_exists($app, $helper)) {
            return $app->{$helper}();
        }

        // Lumen
        return $app->basePath($envFile);
    }
}

if (! function_exists('alphanumeric')) {
    /**
     * Strip all symbols from a string.
     *
     * @see https://stackoverflow.com/a/16791863/2732184 Source
     *
     * @param string  $str
     *
     * @return string
     */
    function alphanumeric($str): string
    {
        return preg_replace('/[^\p{L}\p{N}\s]/u', '', $str);
    }
}

if (! function_exists('array_merge_recursive_distinct')) {
    /**
     * Merge arrays recursively - but distinctly.
     *
     * @see https://www.php.net/manual/en/function.array-merge-recursive.php#92195 Issue
     * @see https://stackoverflow.com/a/25712428 Solution
     *
     * @param string  $str
     *
     * @return string
     */
    function array_merge_recursive_distinct(array $array1, array $array2)
    {
        $merged = $array1;

        foreach ($array2 as $key => & $value) {
            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
                $merged[$key] = array_merge_recursive_distinct($merged[$key], $value);
            } elseif (is_numeric($key)) {
                if (! in_array($value, $merged)) {
                    $merged[] = $value;
                }
            } else {
                $merged[$key] = $value;
            }
        }

        return $merged;
    }
}

if (! function_exists('append_log_middleware')) {
    /**
     * Add log middleware to handler stack.
     *
     * @see https://github.com/guzzle/guzzle/blob/master/src/MessageFormatter.php
     *
     * @param \GuzzleHttp\HandlerStack $handlerStack
     *
     * @throws \Exception
     *
     * @return \GuzzleHttp\HandlerStack
     */
    function append_log_middleware(HandlerStack $handlerStack)
    {
        $messageFormats = [
            '[Request Headers] {req_headers}',
            '[Request Body] {req_body}',
            '[Response Headers] {res_headers}',
            '[Response Body] {res_body}',
            '[Error] {error}',
        ];
        
        $logger = Container::getInstance()->get('log');

        collect($messageFormats)->each(function ($messageFormat) use ($logger, $handlerStack) {
            $messageFormatter = new MessageFormatter($messageFormat);

            $logMiddleware = Middleware::log($logger, $messageFormatter);

            $handlerStack->unshift($logMiddleware);
        });

        return $handlerStack;
    }
}
