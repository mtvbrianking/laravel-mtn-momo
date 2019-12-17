<?php

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
