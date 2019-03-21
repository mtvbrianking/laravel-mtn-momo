<?php

return [

    'app' => [
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
    ],

    'api' => [
        /*
         * API base URI.
         */
        'base_uri' => env('MOMO_BASE_URI', 'https://ericssonbasicapi2.azure-api.net/'),

        /*
         * Register client ID URI
         */
        'client_id_uri' => env('MOMO_CLIENT_ID_URI', 'v1_0/apiuser'),

        /*
         * Validate client ID URI
         */
        'client_id_status_uri' => env('MOMO_VALIDATE_CLIENT_ID_URI', 'v1_0/apiuser/'.env('MOMO_CLIENT_ID')),

        /*
         * Generate client secret URI
         */
        'client_secret_uri' => env('MOMO_CLIENT_SECRET_URI', 'v1_0/apiuser/'.env('MOMO_CLIENT_ID').'/apikey'),
    ],

    'products' => [
        'collection' => [
            // Token uri
            'token_uri' => env('MOMO_COLLECTION_TOKEN_URI', 'collection/token'),

            // Transact (collect)
            'transact_uri' => env('MOMO_COLLECTION_TRANSACTION_URI', 'collection/v1_0/requesttopay'),

            // Transaction status
            'transaction_status_uri' => env('MOMO_COLLECTION_TRANSACTION_STATUS_URI', 'collection/v1_0/requesttopay/{transaction_id}'),

            // App account balance
            'app_balance_uri' => env('MOMO_COLLECTION_APP_BALANCE_URI', 'collection/v1_0/account/balance'),

            // User account status
            'user_account_uri' => env('MOMO_COLLECTION_USER_ACCOUNT_URI', 'collection/v1_0/accountholder/{account_type_name}/{account_id}/active'),
        ],
        'disbursement' => [
            // Token uri
            'token_uri' => env('MOMO_DISBURSEMENT_TOKEN_URI', 'disbursement/token'),

            // Transact (disburse)
            'transact_uri' => env('MOMO_DISBURSEMENT_TRANSACTION_URI', 'disbursement/v1_0/transfer'),

            // Transaction status
            'transaction_status_uri' => env('MOMO_DISBURSEMENT_TRANSACTION_STATUS_URI', 'disbursement/v1_0/transfer/{transaction_id}'),

            // App account balance
            'app_balance_uri' => env('MOMO_DISBURSEMENT_APP_BALANCE_URI', 'disbursement/v1_0/account/balance'),

            // User account status
            'user_account_uri' => env('MOMO_DISBURSEMENT_USER_ACCOUNT_URI', 'disbursement/v1_0/accountholder/{account_type_name}/{account_id}/active'),
        ],
        'remittance' => [
            // Token uri
            'token_uri' => env('MOMO_REMITTANCE_TOKEN_URI', 'remittance/token'),

            // Transact (remit)
            'transact_uri' => env('MOMO_REMITTANCE_TRANSACTION_URI', 'remittance/v1_0/transfer'),

            // Transaction status
            'transaction_status_uri' => env('MOMO_REMITTANCE_TRANSACTION_STATUS_URI', 'remittance/v1_0/transfer/{transaction_id}'),

            // App account balance
            'app_balance_uri' => env('MOMO_REMITTANCE_APP_BALANCE_URI', 'remittance/v1_0/account/balance'),

            // User account status
            'user_account_uri' => env('MOMO_REMITTANCE_USER_ACCOUNT_URI', 'remittance/v1_0/accountholder/{account_type_name}/{account_id}/active'),
        ],
    ],

];
