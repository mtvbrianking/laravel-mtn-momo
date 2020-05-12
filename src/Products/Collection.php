<?php
/**
 * Collection.
 */

namespace Bmatovu\MtnMomo\Products;

use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Container\Container;
use Illuminate\Contracts\Config\Repository;
use Ramsey\Uuid\Uuid;

/**
 * Collection service/product.
 */
class Collection extends Product
{
    /**
     * Product.
     *
     * @var string
     */
    const PRODUCT = 'collection';

    /**
     * Transact URI.
     *
     * @var string
     */
    protected $transactionUri;

    /**
     * Transaction status URI.
     *
     * @var string
     */
    protected $transactionStatusUri;

    /**
     * Account status URI.
     *
     * @var string
     */
    protected $accountStatusUri;

    /**
     * Account balance URI.
     *
     * @var string
     */
    protected $accountBalanceUri;

    /**
     * @return string
     */
    public function getTransactionUri()
    {
        return $this->transactionUri;
    }

    /**
     * @param string $transactionUri
     */
    public function setTransactionUri($transactionUri)
    {
        $this->transactionUri = $transactionUri;
    }

    /**
     * @return string
     */
    public function getTransactionStatusUri()
    {
        return $this->transactionStatusUri;
    }

    /**
     * @param string $transactionStatusUri
     */
    public function setTransactionStatusUri($transactionStatusUri)
    {
        $this->transactionStatusUri = $transactionStatusUri;
    }

    /**
     * @return string
     */
    public function getAccountStatusUri()
    {
        return $this->accountStatusUri;
    }

    /**
     * @param string $accountStatusUri
     */
    public function setAccountStatusUri($accountStatusUri)
    {
        $this->accountStatusUri = $accountStatusUri;
    }

    /**
     * @return string
     */
    public function getAppAccountBalanceUri()
    {
        return $this->accountBalanceUri;
    }

    /**
     * @param string $accountBalanceUri
     */
    public function setAppAccountBalanceUri($accountBalanceUri)
    {
        $this->accountBalanceUri = $accountBalanceUri;
    }

    /**
     * Constructor.
     *
     * @param array $headers
     * @param array $middleware
     * @param \GuzzleHttp\ClientInterface $client
     *
     * @uses \Illuminate\Contracts\Config\Repository
     *
     * @throws \Exception
     */
    public function __construct($headers = [], $middleware = [], ClientInterface $client = null)
    {
        $config = Container::getInstance()->make(Repository::class);

        $this->subscriptionKey = $config->get('mtn-momo.products.collection.key');
        $this->clientId = $config->get('mtn-momo.products.collection.id');
        $this->clientSecret = $config->get('mtn-momo.products.collection.secret');
        $this->clientCallbackUri = $config->get('mtn-momo.products.collection.callback_uri');

        $this->tokenUri = $config->get('mtn-momo.products.collection.token_uri');
        $this->transactionUri = $config->get('mtn-momo.products.collection.transaction_uri');
        $this->transactionStatusUri = $config->get('mtn-momo.products.collection.transaction_status_uri');
        $this->accountStatusUri = $config->get('mtn-momo.products.collection.account_status_uri');
        $this->accountBalanceUri = $config->get('mtn-momo.products.collection.account_balance_uri');
        $this->partyIdType = $config->get('mtn-momo.products.collection.party_id_type');

        parent::__construct($headers, $middleware, $client);
    }

    /**
     * Request payee to pay.
     *
     * @see https://momodeveloper.mtn.com/docs/services/collection/operations/requesttopay-POST Documentation
     *
     * @param  string $transactionId Your transaction reference ID, Say: order number.
     * @param  string $partyId Account holder. Usually phone number if type is MSISDN.
     * @param  int $amount How much to debit the payer.
     * @param  string $payerMessage Payer transaction history message.
     * @param  string $payeeNote Payee transaction history message.
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\CollectionRequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     *
     * @return string                Auto generated payment reference. Format: UUID
     */
    public function requestToPay($transactionId, $partyId, $amount, $payerMessage = '', $payeeNote = '')
    {
        $momoTransactionId = Uuid::uuid4()->toString();

        $headers = [
            'X-Reference-Id' => $momoTransactionId,
            'X-Target-Environment' => $this->environment,
        ];

        if ($this->environment != 'sandbox') {
            $headers['X-Callback-Url'] = $this->clientCallbackUri;
        }

        try {
            $this->client->request('POST', $this->transactionUri, [
                'headers' => $headers,
                'json' => [
                    'amount' => $amount,
                    'currency' => $this->currency,
                    'externalId' => $transactionId,
                    'payer' => [
                        'partyIdType' => $this->partyIdType,
                        'partyId' => $partyId,
                    ],
                    'payerMessage' => alphanumeric($payerMessage),
                    'payeeNote' => alphanumeric($payeeNote),
                ],
            ]);

            return $momoTransactionId;
        } catch (RequestException $ex) {
            throw new CollectionRequestException('Request to pay transaction - unsuccessful.', 0, $ex);
        }
    }

    /**
     * Get transaction status.
     *
     * @see https://momodeveloper.mtn.com/docs/services/collection/operations/requesttopay-referenceId-GET Documentation
     *
     * @param  string $momoTransactionId MTN Momo transaction ID. Returned from transact (requestToPay)
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\CollectionRequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return array
     */
    public function getTransactionStatus($momoTransactionId)
    {
        $transactionStatusUri = str_replace('{momoTransactionId}', $momoTransactionId, $this->transactionStatusUri);

        try {
            $response = $this->client->request('GET', $transactionStatusUri, [
                'headers' => [
                    'X-Target-Environment' => $this->environment,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $ex) {
            throw new CollectionRequestException('Unable to get transaction status.', 0, $ex);
        }
    }

    /**
     * Request collections access token.
     *
     * @see https://momodeveloper.mtn.com/docs/services/collection/operations/token-POST Documentation
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\CollectionRequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return array
     */
    public function getToken()
    {
        try {
            $response = $this->client->request('POST', $this->tokenUri, [
                'headers' => [
                    'Authorization' => 'Basic '.base64_encode($this->clientId.':'.$this->clientSecret),
                ],
                'json' => [
                    'grant_type' => 'client_credentials',
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $ex) {
            throw new CollectionRequestException('Unable to get token.', 0, $ex);
        }
    }

    /**
     * Get account balance.
     *
     * @see https://momodeveloper.mtn.com/docs/services/collection/operations/get-v1_0-account-balance Documentation
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\CollectionRequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return array Account balance.
     */
    public function getAccountBalance()
    {
        try {
            $response = $this->client->request('GET', $this->accountBalanceUri, [
                'headers' => [
                    'X-Target-Environment' => $this->environment,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $ex) {
            throw new CollectionRequestException('Unable to get account balance.', 0, $ex);
        }
    }

    /**
     * Determine if an account holder is registered and active.
     *
     * @see https://momodeveloper.mtn.com/docs/services/collection/operations/get-v1_0-accountholder-accountholderidtype-accountholderid-active Documentation
     *
     * @param  string $partyId Party number - MSISDN, email, or code - UUID.
     * @param  string $partyIdType Allowed values [msisdn, email, party_code].
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\CollectionRequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return bool True if account holder is registered and active, false if the account holder is not active or not found
     */
    public function isActive($partyId, $partyIdType = null)
    {
        if (is_null($partyIdType)) {
            $partyIdType = $this->partyIdType;
        }

        $patterns = $replacements = [];

        $patterns[] = '/(\{\bpartyIdType\b\})/';
        $replacements[] = strtolower($partyIdType);

        $patterns[] = '/(\{\bpartyId\b\})/';
        $replacements[] = urlencode($partyId);

        $accountStatusUri = preg_replace($patterns, $replacements, $this->accountStatusUri);

        try {
            $response = $this->client->request('GET', $accountStatusUri, [
                'headers' => [
                    'X-Target-Environment' => $this->environment,
                ],
            ]);

            $body = json_decode($response->getBody(), true);

            return (bool) $body['result'];
        } catch (RequestException $ex) {
            throw new CollectionRequestException('Unable to get user account information.', 0, $ex);
        }
    }
}
