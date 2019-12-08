<?php

use Illuminate\Container\Container;

if (! function_exists('environment_file_path')) {
    /**
     * Get application environment file path.
     *
     * @param  string  path
     * @param mixed $path
     *
     * @return string
     */
    function environment_file_path($path = '.env'): string
    {
        $app = Container::getInstance();

        if (method_exists($app, 'environmentFilePath')) {
            return $app->environmentFilePath();
        }

        // Lumen
        return $app->basePath($path);
    }
}
