<?php

namespace Bmatovu\MtnMomo\Product;

use Monolog\Logger;
use Ramsey\Uuid\Uuid;
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use Illuminate\Console\Command;
use GuzzleHttp\MessageFormatter;
use Bmatovu\MtnMomo\Model\Token;
use Monolog\Handler\StreamHandler;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Contracts\Config\Repository;

use Bmatovu\MtnMomo\Http\OAuth2Middleware;
use Bmatovu\MtnMomo\Http\GrantType\ClientCredentials;

class Collection
{
    /**
     * HTTP client.
     * @var \GuzzleHttp\Guzzle\Client
     */
    protected $client;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $stack = HandlerStack::create();

        // ...........................................................

        // Authorization client - this is used to request OAuth access tokens
        $client = new Client([
            'progress' => function () {
                echo '. ';
            },
            'base_uri' => $this->configuration()->get('mtn-momo.api.base_uri'),
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Ocp-Apim-Subscription-Key' => $this->configuration()->get('mtn-momo.app.product_key'),
            ],
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

        $stack->push(
            Middleware::log(
                $logger,
                new MessageFormatter("\r\n[Request] >>>>> {request}. [Response] >>>>> \r\n{response}.")
            )
        );

        // ...........................................................

        // This is the normal Guzzle client that you use in your application
        $this->client = new Client([
            'handler' => $stack,
            'progress' => function () {
                echo '. ';
            },
            'base_uri' => $this->configuration()->get('mtn-momo.api.base_uri'),
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Ocp-Apim-Subscription-Key' => $this->configuration()->get('mtn-momo.app.product_key'),
            ],
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
     * @param  string $external_id   Transaction reference ID.
     * @param  string $currency      Currency code, like 'USD'.
     * @param  int    $amount        How much to debit the payer.
     * @param  string $party_id_type Account holder type. Default:MSISDN
     * @param  strinh $party_id      Account holder. Ususally phone number if type is MSISDN.
     * @param  string $payer_message Payer transaction history message.
     * @param  string $payee_note    Payee transaction history message.
     * @return array                 API response.
     */
    public function transact($external_id, $amount, $currency, $party_id, $party_id_type = 'MSISDN', $payer_message = '', $payee_note = '')
    {
        try {
            $response = $this->client->request('POST', $this->configuration()->get('mtn-momo.products.collection.transact_uri'), [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Ocp-Apim-Subscription-Key' => $this->configuration()->get('mtn-momo.app.product_key'),
                    'X-Reference-Id' => $this->configuration()->get('mtn-momo.client.id'),
                ],
                'json' => [
                    'amount' => $amount,
                    'currency' => $currency,
                    'externalId' => $external_id,
                    'payer' => [
                        'partyIdType' => $party_id_type,
                        'partyId' => $party_id,
                    ],
                    'payerMessage' => $payer_message,
                    'payeeNote' => $payee_note,
                ],
            ]);

            return json_decode($response->getBody(), true);

        } catch (ConnectException $ex) {
            return [
                'message' => $ex->getMessage(),
            ];
        } catch (ClientException $ex) {
            $response = $ex->getResponse();
            return [
                'status' => $response->getStatusCode(),
                'reason' => $response->getReasonPhrase(),
                'body' => json_decode($response->getBody()),
            ];
        } catch (ServerException $ex) {
            $response = $ex->getResponse();
            return [
                'status' => $response->getStatusCode(),
                'reason' => $response->getReasonPhrase(),
                'body' => $response->getBody(),
            ];
        }
    }

    public function getTransactionStatus()
    {
        print("Transact/collect what?");
    }

    /**
     * Request access token.
     * @return [type] [description]
     */
    public function token()
    {

    }

    /**
     * Get account balance.
     * @return [type] [description]
     */
    public function getAccountBalance()
    {

    }

    /**
     * Get user account information.
     * @return [type] [description]
     */
    public function getUserAccountInfo()
    {

    }

}
