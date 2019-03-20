<?php

return [
    /*
     * Transaction currency code.
     */
    'currency' => env('MOMO_CURRENCY', 'EUR'),

    /*
     * Target environment.
     *
     * Also called; targetEnvironment
     */
    'environment' => env('MOMO_ENVIRONMENT', 'sandbox'),

    /*
     * Product.
     *
     * The product you subscribed too.
     *
     * @see https://momodeveloper.mtn.com/products
     */
    'product' => env('MOMO_PRODUCT', 'collection'),

    /*
     * Production subscription key.
     *
     * Also called; Ocp-Apim-Subscription-Key
     */
    'product_key' => env('MOMO_PRODUCT_KEY'),

    'client' => [
        /*
         * Momo API application name.
         *
         * This could be indicated in the message sent to the payee.
         */
        'name' => env('MOMO_CLIENT_NAME', 'Laravel'),

        /*
         * Client app ID.
         *
         * Also called; X-Reference-Id and api_user_id interchangeably
         *
         * User generated UUID4 string, and it has to be registered with the API.
         */
        'id' => env('MOMO_CLIENT_ID'),

        /*
         * Client app secret.
         *
         * Also called; apiKey
         *
         * Request for secret from the API.
         */
        'secret' => env('MOMO_CLIENT_SECRET'),

        /*
         * Redirect URI.
         *
         * Also called; providerCallbackHost
         */
        'redirect_uri' => env('MOMO_CLIENT_REDIRECT_URI', ''),
    ],

    'uri' => [
        /*
         * API base URI.
         */
        'base' => env('MOMO_BASE_URI', 'https://ericssonbasicapi2.azure-api.net/'),

        /*
         * Register client ID URI
         */
        'client_id' => env('MOMO_CLIENT_ID_URI', 'v1_0/apiuser'),

        /*
         * Validate client ID URI
         */
        'val_client_id' => env('MOMO_VALIDATE_CLIENT_ID_URI', 'v1_0/apiuser/'.env('MOMO_CLIENT_ID')),

        /*
         * Generate client secret URI
         */
        'client_secret' => env('MOMO_CLIENT_SECRET_URI', 'v1_0/apiuser/'.env('MOMO_CLIENT_ID').'/apiKey'),

        /*
         * Token uri
         */
        'token' => env('MOMO_TOKEN_URI', env('MOMO_PRODUCT', 'collection').'/token'),

        /*
         * Refresh token uri
         */
        'refresh_token' => env('MOMO_REFRESH_TOKEN_URI', env('MOMO_PRODUCT', 'collection').'/token'),
    ],

];
