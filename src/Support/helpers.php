<?php

use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Illuminate\Container\Container;
use Illuminate\Support\Str;

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
        $id = Str::random(10);

        $messageFormats = [
            "HTTP_OUT_{$id} [Request] {method} {target}" => 'info',
            "HTTP_OUT_{$id} [Request] [Headers] \n{req_headers}" => 'debug',
            "HTTP_OUT_{$id} [Request] [Body] {req_body}" => 'debug',
            "HTTP_OUT_{$id} [Response] HTTP/{version} {code} {phrase} Size: {res_header_Content-Length}" => 'info',
            "HTTP_OUT_{$id} [Response] [Headers] \n{res_headers}" => 'debug',
            "HTTP_OUT_{$id} [Response] [Body] {res_body}" => 'debug',
            "HTTP_OUT_{$id} [Error] {error}" => 'error',
        ];

        $logger = Container::getInstance()->get('log');

        collect($messageFormats)->each(function ($level, $format) use ($logger, $handlerStack) {
            $messageFormatter = new MessageFormatter($format);

            $logMiddleware = Middleware::log($logger, $messageFormatter, $level);

            $handlerStack->unshift($logMiddleware);
        });

        return $handlerStack;
    }
}
