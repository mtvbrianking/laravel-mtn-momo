<?php

return [

    /*
     * Momo API client application name.
     *
     * This could be indicated in the message sent to the payee.
     */
    'app' => env('MOMO_APP', 'Laravel MTN Momo'),

    // Transaction currency code.
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

    'log' => env('MOMO_LOG', 'mtn-momo.log'),

    'api' => [
        // API base URI.
        'base_uri' => env('MOMO_API_BASE_URI', 'https://sandbox.momodeveloper.mtn.com/'),

        // Register client ID URI
        'register_id_uri' => env('MOMO_API_REGISTER_ID_URI', 'v1_0/apiuser'),

        // Validate client ID URI
        'validate_id_uri' => env('MOMO_API_VALIDATE_ID_URI', 'v1_0/apiuser/{clientId}'),

        // Generate client secret URI
        'request_secret_uri' => env('MOMO_API_REQUEST_SECRET_URI', 'v1_0/apiuser/{clientId}/apikey'),
    ],

    'products' => [
        'collection' => [
            /*
             * Client app ID.
             *
             * Also called; X-Reference-Id and api_user_id interchangeably
             *
             * User generated UUID4 string, and it has to be registered with the API.
             */
            'id' => env('MOMO_COLLECTION_ID'),

            /*
             * Redirect URI.
             *
             * Also called; providerCallbackHost
             */
            'redirect_uri' => env('MOMO_COLLECTION_REDIRECT_URI'),

            /*
             * Client app secret.
             *
             * Also called; apiKey
             *
             * Requested for secret from the MTN Momo API.
             */
            'secret' => env('MOMO_COLLECTION_SECRET'),

            /*
             * Production subscription key.
             *
             * Also called; Ocp-Apim-Subscription-Key
             */
            'key' => env('MOMO_COLLECTION_SUBSCRIPTION_KEY'),

            // Party ID type
            'party_id_type' => env('MOMO_COLLECTION_PARTY_ID_TYPE', 'msisdn'),

            // Token uri
            'token_uri' => env('MOMO_COLLECTION_TOKEN_URI', 'collection/token/'),

            // Transact (collect)
            'transaction_uri' => env('MOMO_COLLECTION_TRANSACTION_URI', 'collection/v1_0/requesttopay'),

            // Transaction status
            'transaction_status_uri' => env(
                'MOMO_COLLECTION_TRANSACTION_STATUS_URI',
                'collection/v1_0/requesttopay/{momoTransactionId}'
            ),

            // Account balance
            'account_balance_uri' => env('MOMO_COLLECTION_APP_BALANCE_URI', 'collection/v1_0/account/balance'),

            // Account status
            'account_status_uri' => env(
                'MOMO_COLLECTION_USER_ACCOUNT_URI',
                'collection/v1_0/accountholder/{partyIdType}/{partyId}/active'
            ),
        ],
        'disbursement' => [
            'id' => env('MOMO_DISBURSEMENT_ID'),

            'redirect_uri' => env('MOMO_DISBURSEMENT_REDIRECT_URI'),

            'secret' => env('MOMO_DISBURSEMENT_SECRET'),

            'key' => env('MOMO_DISBURSEMENT_SUBSCRIPTION_KEY'),

            'party_id_type' => env('MOMO_DISBURSEMENT_PARTY_ID_TYPE', 'msisdn'),

            // Token uri
            'token_uri' => env('MOMO_DISBURSEMENT_TOKEN_URI', 'disbursement/token/'),

            // Transact (disburse)
            'transaction_uri' => env('MOMO_DISBURSEMENT_TRANSACTION_URI', 'disbursement/v1_0/transfer'),

            // Transaction status
            'transaction_status_uri' => env(
                'MOMO_DISBURSEMENT_TRANSACTION_STATUS_URI',
                'disbursement/v1_0/transfer/{momoTransactionId}'
            ),

            // Account balance
            'account_balance_uri' => env('MOMO_DISBURSEMENT_APP_BALANCE_URI', 'disbursement/v1_0/account/balance'),

            // Account status
            'account_status_uri' => env(
                'MOMO_DISBURSEMENT_USER_ACCOUNT_URI',
                'disbursement/v1_0/accountholder/{partyIdType}/{partyId}/active'
            ),
        ],
        'remittance' => [
            'id' => env('MOMO_REMITTANCE_ID'),

            'redirect_uri' => env('MOMO_REMITTANCE_REDIRECT_URI'),

            'secret' => env('MOMO_REMITTANCE_SECRET'),

            'key' => env('MOMO_REMITTANCE_SUBSCRIPTION_KEY'),

            'party_id_type' => env('MOMO_REMITTANCE_PARTY_ID_TYPE', 'msisdn'),

            // Token uri
            'token_uri' => env('MOMO_REMITTANCE_TOKEN_URI', 'remittance/token/'),

            // Transact (remit)
            'transaction_uri' => env('MOMO_REMITTANCE_TRANSACTION_URI', 'remittance/v1_0/transfer'),

            // Transaction status
            'transaction_status_uri' => env(
                'MOMO_REMITTANCE_TRANSACTION_STATUS_URI',
                'remittance/v1_0/transfer/{momoTransactionId}'
            ),

            // Account balance
            'account_balance_uri' => env('MOMO_REMITTANCE_APP_BALANCE_URI', 'remittance/v1_0/account/balance'),

            // Account status
            'account_status_uri' => env(
                'MOMO_REMITTANCE_USER_ACCOUNT_URI',
                'remittance/v1_0/accountholder/{partyIdType}/{partyId}/active'
            ),
        ],
    ],

    /*
     * GuzzleHttp client request options.
     * http://docs.guzzlephp.org/en/stable/request-options.html
     */
    'guzzle' => [
        'options' => [
            // 'verify' => false,
        ],
    ],
];
