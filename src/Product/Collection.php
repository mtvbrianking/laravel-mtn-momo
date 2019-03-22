<?php

namespace Bmatovu\MtnMomo\Product;

use Monolog\Logger;
use Ramsey\Uuid\Uuid;
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use Bmatovu\MtnMomo\Model\Token;
use GuzzleHttp\MessageFormatter;
use Monolog\Handler\StreamHandler;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Bmatovu\MtnMomo\Http\OAuth2Middleware;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Contracts\Config\Repository;
use Bmatovu\MtnMomo\Http\GrantType\ClientCredentials;

class Collection
{
    /**
     * HTTP client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $stack = HandlerStack::create();

        // ...........................................................

        // Default Headers
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Ocp-Apim-Subscription-Key' => $this->configuration()->get('mtn-momo.app.product_key'),
        ];

        // Authorization client - this is used to request OAuth access tokens
        $client = new Client([
            'progress' => function () {
                echo '. ';
            },
            'base_uri' => $this->configuration()->get('mtn-momo.api.base_uri'),
            'headers' => $headers,
            'json' => [
                'body',
            ],
        ]);

        $config = [
            'client_id' => $this->configuration()->get('mtn-momo.app.id'),
            'client_secret' => $this->configuration()->get('mtn-momo.app.secret'),
            'token_uri' => $this->configuration()->get('mtn-momo.products.collection.token_uri'),
        ];

        // This grant type is used to get a new Access Token and,
        // Refresh Token when no valid Access Token or Refresh Token is available
        $client_grant = new ClientCredentials($client, $config);

        // Tell the middleware to use both the client and refresh token grants
        $oauth = new OAuth2Middleware($client_grant);

        $stack->push($oauth);

        // ...........................................................

        $logger = new Logger('Logger');
        $logger->pushHandler(new StreamHandler(storage_path('logs/mtn-momo.log')), Logger::DEBUG);

        $stack->push(Middleware::log($logger, new MessageFormatter("\r\n[Request] >>>>> {request}. [Response] >>>>> \r\n{response}.")));

        // ...........................................................

        // This is the normal Guzzle client that you use in your application
        $this->client = new Client([
            'handler' => $stack,
            'progress' => function () {
                echo '. ';
            },
            'base_uri' => $this->configuration()->get('mtn-momo.api.base_uri'),
            'headers' => $headers,
        ]);
    }

    /**
     * Get the configuration repository instance.
     *
     * @return \Illuminate\Contracts\Config\Repository
     */
    protected function configuration()
    {
        return Container::getInstance()->make(Repository::class);
    }

    /**
     * Request payee to pay.
     *
     * @see https://momodeveloper.mtn.com/docs/services/collection/operations/requesttopay-POST Documentation
     *
     * @param  string $external_id Transaction reference ID.
     * @param  int $amount How much to debit the payer.
     * @param  string $party_id Account holder. Usually phone number if type is MSISDN.
     * @param  string $payer_message Payer transaction history message.
     * @param  string $payee_note Payee transaction history message.
     * @return string                Payment reference ID
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function transact($external_id, $party_id, $amount, $payer_message = '', $payee_note = '')
    {
        $payment_ref = Uuid::uuid4()->toString();

        $resource = $this->configuration()->get('mtn-momo.products.collection.transact_uri');

        try {
            $response = $this->client->request('POST', $resource, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Ocp-Apim-Subscription-Key' => $this->configuration()->get('mtn-momo.app.product_key'),
                    'X-Reference-Id' => $payment_ref,
                    // 'X-Callback-Url' => $this->configuration()->get('mtn-momo.app.redirect_uri'),
                    'X-Target-Environment' => $this->configuration()->get('mtn-momo.app.environment'),
                ],
                'json' => [
                    'amount' => $amount,
                    'currency' => $this->configuration()->get('mtn-momo.app.currency'),
                    'externalId' => $external_id,
                    'payer' => [
                        'partyIdType' => $this->configuration()->get('mtn-momo.products.collection.party_id_type'),
                        'partyId' => $party_id,
                    ],
                    'payerMessage' => $payer_message,
                    'payeeNote' => $payee_note,
                ],
            ]);

            return $payment_ref;
        } catch (ConnectException $ex) {
            var_dump([
                'message' => $ex->getMessage(),
            ]);
        } catch (ClientException $ex) {
            $response = $ex->getResponse();

            var_dump([
                'status' => $response->getStatusCode(),
                'reason' => $response->getReasonPhrase(),
                'body' => json_decode($response->getBody()),
            ]);
        } catch (ServerException $ex) {
            $response = $ex->getResponse();

            var_dump([
                'status' => $response->getStatusCode(),
                'reason' => $response->getReasonPhrase(),
                'body' => json_encode($response->getBody()),
            ]);
        }
    }

    /**
     * Get transaction status.
     *
     * @param  string $payment_ref ID
     * @return array Payment data
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTransactionStatus($payment_ref)
    {
        $resource = preg_replace('/(\{\btransaction_id\b\})$/', // '/(\{\b\w+\b\})$/',
            $payment_ref, $this->configuration()->get('mtn-momo.products.collection.transaction_status_uri'));

        try {
            $response = $this->client->request('GET', $resource, [
                'headers' => [
                    'Ocp-Apim-Subscription-Key' => $this->configuration()->get('mtn-momo.app.product_key'),
                    'X-Target-Environment' => $this->configuration()->get('mtn-momo.app.environment'),
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (ConnectException $ex) {
            var_dump([
                'message' => $ex->getMessage(),
            ]);
        } catch (ClientException $ex) {
            $response = $ex->getResponse();

            var_dump([
                'status' => $response->getStatusCode(),
                'reason' => $response->getReasonPhrase(),
                'body' => json_decode($response->getBody()),
            ]);
        } catch (ServerException $ex) {
            $response = $ex->getResponse();

            var_dump([
                'status' => $response->getStatusCode(),
                'reason' => $response->getReasonPhrase(),
                'body' => json_encode($response->getBody()),
            ]);
        }
    }

    /**
     * Request access token.
     *
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function token()
    {
        $resource = $this->configuration()->get('mtn-momo.products.collection.app_account_balance_uri');

        try {
            $response = $this->client->request('POST', $resource, [
                'headers' => [
                    'Authorization' => 'Basic '.base64_encode($this->configuration()->get('client_id').':'.configuration()->get('client_secret')),
                    'Ocp-Apim-Subscription-Key' => $this->configuration()->get('mtn-momo.app.product_key'),
                ],
                'json' => [
                    'grant_type' => 'client_credentials',
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (ConnectException $ex) {
            var_dump([
                'message' => $ex->getMessage(),
            ]);
        } catch (ClientException $ex) {
            $response = $ex->getResponse();

            var_dump([
                'status' => $response->getStatusCode(),
                'reason' => $response->getReasonPhrase(),
                'body' => json_decode($response->getBody()),
            ]);
        } catch (ServerException $ex) {
            $response = $ex->getResponse();

            var_dump([
                'status' => $response->getStatusCode(),
                'reason' => $response->getReasonPhrase(),
                'body' => json_encode($response->getBody()),
            ]);
        }
    }

    /**
     * Get account balance.
     *
     * @return array Account balance.
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAccountBalance()
    {
        $resource = $this->configuration()->get('mtn-momo.products.collection.app_account_balance_uri');

        try {
            $response = $this->client->request('GET', $resource, [
                'headers' => [
                    'Ocp-Apim-Subscription-Key' => $this->configuration()->get('mtn-momo.app.product_key'),
                    'X-Target-Environment' => $this->configuration()->get('mtn-momo.app.environment'),
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (ConnectException $ex) {
            var_dump([
                'message' => $ex->getMessage(),
            ]);
        } catch (ClientException $ex) {
            $response = $ex->getResponse();

            var_dump([
                'status' => $response->getStatusCode(),
                'reason' => $response->getReasonPhrase(),
                'body' => json_decode($response->getBody()),
            ]);
        } catch (ServerException $ex) {
            $response = $ex->getResponse();

            var_dump([
                'status' => $response->getStatusCode(),
                'reason' => $response->getReasonPhrase(),
                'body' => json_encode($response->getBody()),
            ]);
        }
    }

    /**
     * Get user account information.
     *
     * @param  string $account_id
     * @param  string $account_type_name
     * @return array User account info
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getUserAccountInfo($account_id, $account_type_name = null)
    {
        $resource = $this->configuration()->get('mtn-momo.products.collection.user_account_uri');

        if (is_null($account_type_name)) {
            $account_type_name = $this->configuration()->get('mtn-momo.products.collection.party_id_type');
        }

        $patterns[] = '/(\{\baccount_type_name\b\})/';
        $replacements[] = strtolower($account_type_name);

        $patterns[] = '/(\{\baccount_id\b\})/';
        $replacements[] = $account_id;

        $resource = preg_replace($patterns, $replacements, $resource);

        try {
            $response = $this->client->request('GET', $resource, [
                'headers' => [
                    'Ocp-Apim-Subscription-Key' => $this->configuration()->get('mtn-momo.app.product_key'),
                    'X-Target-Environment' => $this->configuration()->get('mtn-momo.app.environment'),
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (ConnectException $ex) {
            var_dump([
                'message' => $ex->getMessage(),
            ]);
        } catch (ClientException $ex) {
            $response = $ex->getResponse();

            var_dump([
                'status' => $response->getStatusCode(),
                'reason' => $response->getReasonPhrase(),
                'body' => json_decode($response->getBody()),
            ]);
        } catch (ServerException $ex) {
            $response = $ex->getResponse();

            var_dump([
                'status' => $response->getStatusCode(),
                'reason' => $response->getReasonPhrase(),
                'body' => json_encode($response->getBody()),
            ]);
        }
    }
}
