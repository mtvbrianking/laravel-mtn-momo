<?php

/**
 * Disbursement service/product.
 */

namespace Bmatovu\MtnMomo\Products;

use Bmatovu\MtnMomo\Exceptions\DisbursementRequestException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Container\Container;
use Illuminate\Contracts\Config\Repository;
use Ramsey\Uuid\Uuid;

/**
 * Class Disbursement.
 */
class Disbursement extends Product
{
    /**
     * Product.
     *
     * @var string
     */
    const PRODUCT = 'disbursement';

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
     * Account holder basic info URI.
     *
     * @var string
     */
    protected $accountHolderInfoUri;

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
    public function getAccountBalanceUri()
    {
        return $this->accountBalanceUri;
    }

    /**
     * @param string $accountBalanceUri
     */
    public function setAccountBalanceUri($accountBalanceUri)
    {
        $this->accountBalanceUri = $accountBalanceUri;
    }

    /**
     * @return string
     */
    public function getAccountHolderInfoUri()
    {
        return $this->accountHolderInfoUri;
    }

    /**
     * @param string $accountHolderInfoUri
     */
    public function setAccountHolderInfoUri($accountHolderInfoUri)
    {
        $this->accountHolderInfoUri = $accountHolderInfoUri;
    }

    /**
     * Disbursement constructor.
     *
     * @param array $headers
     * @param array $middleware
     * @param \GuzzleHttp\ClientInterface $client
     *
     * @uses \Illuminate\Contracts\Config\Repository
     *
     * @throws \Exception
     */
    public function __construct(array $headers = [], array $middleware = [], ClientInterface $client = null)
    {
        $config = Container::getInstance()->make(Repository::class);

        $this->subscriptionKey = $config->get('mtn-momo.products.disbursement.key');
        $this->clientId = $config->get('mtn-momo.products.disbursement.id');
        $this->clientSecret = $config->get('mtn-momo.products.disbursement.secret');
        $this->clientCallbackUri = $config->get('mtn-momo.products.disbursement.callback_uri');

        $this->tokenUri = $config->get('mtn-momo.products.disbursement.token_uri');
        $this->transactionUri = $config->get('mtn-momo.products.disbursement.transaction_uri');
        $this->transactionStatusUri = $config->get('mtn-momo.products.disbursement.transaction_status_uri');
        $this->accountStatusUri = $config->get('mtn-momo.products.disbursement.account_status_uri');
        $this->accountBalanceUri = $config->get('mtn-momo.products.disbursement.account_balance_uri');
        $this->accountHolderInfoUri = $config->get('mtn-momo.products.disbursement.account_holder_info_uri');
        $this->partyIdType = $config->get('mtn-momo.products.disbursement.party_id_type');

        parent::__construct($headers, $middleware, $client);
    }

    /**
     * Request disbursement access token.
     *
     * @see https://momodeveloper.mtn.com/docs/services/disbursement/operations/token-POST Documentation
     *
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
            throw new DisbursementRequestException('Unable to get token.', 0, $ex);
        }
    }

    /**
     * Transfer an amount to a payee account.
     *
     * @see https://momodeveloper.mtn.com/docs/services/disbursement/operations/transfer-POST Documentation
     *
     * @param  string $transactionId Transaction reference ID.
     * @param  string $partyId Account holder. Usually phone number if type is MSISDN.
     * @param  int $amount How much to transfer to payee account.
     * @param  string $payerMessage Payer transaction history message.
     * @param  string $payeeNote Payee transaction history message.
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\DisbursementRequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     *
     * @return string $momoTransactionId                Auto generated payment reference. Format: UUID
     */
    public function transfer($transactionId, $partyId, $amount, $payerMessage = '', $payeeNote = '')
    {
        $momoTransactionId = Uuid::uuid4()->toString();

        $headers = [
            'X-Reference-Id' => $momoTransactionId,
            'X-Target-Environment' => $this->environment,
        ];

        if ($this->environment != 'sandbox' && $this->clientCallbackUri) {
            $headers['X-Callback-Url'] = $this->clientCallbackUri;
        }

        try {
            $this->client->request('POST', $this->transactionUri, [
                'headers' => $headers,
                'json' => [
                    'amount' => $amount,
                    'currency' => $this->currency,
                    'externalId' => $transactionId,
                    'payee' => [
                        'partyIdType' => $this->partyIdType,
                        'partyId' => $partyId,
                    ],
                    'payerMessage' => alphanumeric($payerMessage),
                    'payeeNote' => alphanumeric($payeeNote),
                ],
            ]);

            return $momoTransactionId;
        } catch (RequestException $ex) {
            throw new DisbursementRequestException('Request to transfer transaction - unsuccessful.', 0, $ex);
        }
    }

    /**
     * Get transaction status.
     *
     * @see https://momodeveloper.mtn.com/docs/services/disbursement/operations/transfer-referenceId-GET Documentation
     *
     * @param  string $momoTransactionId That was returned by transfer (transferAmount)
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\DisbursementRequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return array
     */
    public function getTransactionStatus($momoTransactionId)
    {
        $transaction_status_uri = str_replace('{momoTransactionId}', $momoTransactionId, $this->transactionStatusUri);

        try {
            $response = $this->client->request('GET', $transaction_status_uri, [
                'headers' => [
                    'X-Target-Environment' => $this->environment,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $ex) {
            throw new DisbursementRequestException('Unable to get transaction status.', 0, $ex);
        }
    }

    /**
     * Get account balance.
     *
     * @see https://momodeveloper.mtn.com/docs/services/disbursement/operations/get-v1_0-account-balance Documentation
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\DisbursementRequestException
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
            throw new DisbursementRequestException('Unable to get account balance.', 0, $ex);
        }
    }

    /**
     * Determine if an account holder is registered and active.
     *
     * @see https://momodeveloper.mtn.com/docs/services/disbursement/operations/get-v1_0-accountholder-accountholderidtype-accountholderid-active Documentation
     *
     * @param  string $partyId Party number - MSISDN, email, or code - UUID.
     * @param  string $partyIdType Specifies the type of the account ID. Allowed values [msisdn, email, party_code].
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\DisbursementRequestException
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
            throw new DisbursementRequestException('Unable to get user account information.', 0, $ex);
        }
    }

    /**
     * Get basic info of an account holder.
     *
     * @see https://momodeveloper.mtn.com/docs/services/disbursement/operations/basicuserInfo-GET Documentation
     *
     * @param  string $partyId Party number - MSISDN.
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\DisbursementRequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return array account basic info
     */
    public function getAccountHolderBasicInfo($partyId)
    {
        $patterns = $replacements = [];

        $patterns[] = '/(\{\bpartyId\b\})/';
        $replacements[] = urlencode($partyId);

        $accountHolderInfoUri = preg_replace($patterns, $replacements, $this->accountHolderInfoUri);

        try {
            $response = $this->client->request('GET', $accountHolderInfoUri, [
                'headers' => [
                    'X-Target-Environment' => $this->environment,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $ex) {
            throw new DisbursementRequestException('Unable to get user account information.', 0, $ex);
        }
    }
}
