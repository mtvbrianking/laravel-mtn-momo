<?php

return [
    /*
     * Momo API application name.
     *
     * This will be indicated in the message sent to the payee.
     */
    'app' => env('MOMO_APP_NAME', 'Laravel'),

    /*
     * Transaction currency code
     */
    'currency' => env('MOMO_CURRENCY', 'EUR'),

    /*
     * Target environment
     *
     * Also called; targetEnvironment
     */
    'environment' => env('MOMO_ENVIRONMENT', 'sandbox'),

    /*
     * Product.
     *
     * The product you subscribed too.
     *
     * @see https://momodeveloper.mtn.com/products Products
     */
    'product' => env('MOMO_PRODUCT', 'collection'),

    /*
     * Production subscription key.
     *
     * Also called; Ocp-Apim-Subscription-Key
     */
    'product_key' => env('MOMO_PRODUCT_KEY'),

    /*
     * Client app ID.
     *
     * Also called; X-Reference-Id and api_user_id interchangeably
     *
     * User generated UUID4 string, and it has to be registered with the API.
     */
    'client_id' => env('MOMO_CLIENT_ID'),

    /*
     * Client app secret.
     *
     * Also called; apiKey
     *
     * Generate from the API.
     */
    'client_secret' => env('MOMO_CLIENT_SECRET'),

    'uri' => [
        /*
         * Register client ID URI
         */
        'client_id' => env('MOMO_CLIENT_ID_URI'),

        /*
         * Validate client ID URI
         */
        'val_client_id' => env('MOMO_CLIENT_ID_VALIDATE_URI'),

        /*
         * Generate client secret URI
         */
        'client_secret' => env('MOMO_CLIENT_SECRET_URI'),

        /*
         * Redirect URI.
         *
         * Also called; providerCallbackHost
         */
        'redirect' => env('MOMO_REDIRECT_URI'),

        /*
         * Token uri
         */
        'token' => env('MOMO_TOKEN_URI'),

        /*
         * Refresh token uri
         */
        'refresh_token' => env('MOMO_REFRESH_TOKEN_URI'),
    ],

];
