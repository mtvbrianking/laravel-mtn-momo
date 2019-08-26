<?php

/**
 * Disbursement service/product.
 */

namespace Bmatovu\MtnMomo\Products;

use Ramsey\Uuid\Uuid;
use GuzzleHttp\ClientInterface;
use Illuminate\Container\Container;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Contracts\Config\Repository;
use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;

/**
 * Class Disbursement.
 */
class Disbursement extends Product
{
    /**
     * Transact URI.
     *
     * @var string
     */
    protected $transactUri;

    /**
     * Transaction status URI.
     *
     * @var string
     */
    protected $transactionStatusUri;

    /**
     * User account URI.
     *
     * @var string
     */
    protected $userAccountUri;

    /**
     * App account balance URI.
     *
     * @var string
     */
    protected $appAccountBalanceUri;

    /**
     * @return string
     */
    public function getTransactUri()
    {
        return $this->transactUri;
    }

    /**
     * @param string $transactUri
     */
    public function setTransactUri($transactUri)
    {
        $this->transactUri = $transactUri;
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
    public function getUserAccountUri()
    {
        return $this->userAccountUri;
    }

    /**
     * @param string $userAccountUri
     */
    public function setUserAccountUri($userAccountUri)
    {
        $this->userAccountUri = $userAccountUri;
    }

    /**
     * @return string
     */
    public function getAppAccountBalanceUri()
    {
        return $this->appAccountBalanceUri;
    }

    /**
     * @param string $appAccountBalanceUri
     */
    public function setAppAccountBalanceUri($appAccountBalanceUri)
    {
        $this->appAccountBalanceUri = $appAccountBalanceUri;
    }

    /**
     * Disbursement constructor.
     * @param array $headers
     * @param array $middlewares
     * @param \GuzzleHttp\ClientInterface $client
     * @throws \Exception
     */
    public function __construct(array $headers = [], array $middlewares = [], ClientInterface $client = null)
    {
        $config = Container::getInstance()->make(Repository::class);

        $this->setsubscriptionKey($config->get('mtn-momo.products.disbursement.key'));
        $this->setClientId($config->get('mtn-momo.products.disbursement.id'));
        $this->setClientSecret($config->get('mtn-momo.products.disbursement.secret'));
        $this->setClientRedirectUri($config->get('mtn-momo.products.disbursement.redirect_uri'));

        $this->setTokenUri($config->get('mtn-momo.products.disbursement.token_uri'));
        $this->setTransactUri($config->get('mtn-momo.products.disbursement.transact_uri'));
        $this->setTransactionStatusUri($config->get('mtn-momo.products.disbursement.transaction_status_uri'));
        $this->setUserAccountUri($config->get('mtn-momo.products.disbursement.user_account_uri'));
        $this->setAppAccountBalanceUri($config->get('mtn-momo.products.disbursement.app_account_balance_uri'));
        $this->setPartyIdType($config->get('mtn-momo.products.disbursement.party_id_type'));


        parent::__construct($headers, $middlewares, $client);
    }

    /**
     * Request disbursement access token.
     *
     * @see https://momodeveloper.mtn.com/docs/services/disbursement/operations/token-POST Documentation
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getToken()
    {
        $resource = $this->getTokenUri();

        try {
            $client_id = $this->getClientId();
            $client_secret = $this->getClientSecret();

            $response = $this->client->request('POST', $resource, [
                'headers' => [
                    'Authorization' => 'Basic '.base64_encode($client_id.':'.$client_secret),
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
     * Transfer an amount to a payee account.
     *
     * @see https://momodeveloper.mtn.com/docs/services/disbursement/operations/transfer-POST Documentation
     *
     * @param  string $external_id             Transaction reference ID.
     * @param  string $party_id                Account holder. Usually phone number if type is MSISDN.
     * @param  int $amount                     How much to transfer to payee account.
     * @param  string $payer_message           Payer transaction history message.
     * @param  string $payee_note              Payee transaction history message.
     *
     * @return string $payment_ref                Auto generated payment reference. Format: UUID
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function transfer($external_id, $party_id, $amount, $payer_message = '', $payee_note = '')
    {
        $payment_ref = Uuid::uuid4()->toString();

        $resource = $this->getTransactUri();

        $headers = [
            'X-Reference-Id' => $payment_ref,
            'X-Target-Environment' => $this->getEnvironment(),
        ];

        if ($this->getEnvironment() == 'live') {
            $headers['X-Callback-Url'] = $this->getClientRedirectUri();
        }

        try {
            $this->client->request('POST', $resource, [
                'headers' => $headers,
                'json' => [
                    'amount' => $amount,
                    'currency' => $this->getCurrency(),
                    'externalId' => $external_id,
                    'payee' => [
                        'partyIdType' => $this->getPartyIdType(),
                        'partyId' => $party_id,
                    ],
                    'payerMessage' => $payer_message,
                    'payeeNote' => $payee_note,
                ],
            ]);

            return $payment_ref;
        } catch (RequestException $ex) {
            throw new CollectionRequestException('Request to transfer transaction - unsuccessful.', 0, $ex);
        }
    }

    /**
     * Get transaction status.
     *
     * @see https://momodeveloper.mtn.com/docs/services/disbursement/operations/transfer-referenceId-GET Documentation
     *
     * @param  string $payment_ref That was returned by transfer (transferAmount)
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\CollectionRequestException
     *
     * @return array
     */
    public function getDisbursementTransactionStatus($payment_ref)
    {
        $transaction_status_uri = str_replace('{transaction_id}', $payment_ref, $this->getTransactionStatusUri());

        try {
            $response = $this->client->request('GET', $transaction_status_uri, [
                'headers' => [
                    'X-Target-Environment' => $this->getEnvironment(),
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $ex) {
            throw new CollectionRequestException('Unable to get transaction status.', 0, $ex);
        }
    }

    /**
     * Get account balance.
     *
     * @see https://momodeveloper.mtn.com/docs/services/disbursement/operations/get-v1_0-account-balance Documentation
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\CollectionRequestException
     *
     * @return array Account balance.
     */
    public function getAccountBalance()
    {
        $resource = $this->getAppAccountBalanceUri();

        try {
            $response = $this->client->request('GET', $resource, [
                'headers' => [
                    'X-Target-Environment' => $this->getEnvironment(),
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
     * @see https://momodeveloper.mtn.com/docs/services/disbursement/operations/get-v1_0-accountholder-accountholderidtype-accountholderid-active Documentation
     *
     * @param  string $account_id        Party number - MSISDN, email, or code - UUID.
     * @param  string $account_type_name Specifies the type of the account ID. Allowed values [msisdn, email, party_code].
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\CollectionRequestException
     *
     * @return bool True if account holder is registered and active, false if the account holder is not active or not found
     */
    public function isActive($account_id, $account_type_name = null)
    {
        $resource = $this->getUserAccountUri();

        if (is_null($account_type_name)) {
            $account_type_name = $this->getPartyIdType();
        }

        $patterns = $replacements = [];

        $patterns[] = '/(\{\baccount_type_name\b\})/';
        $replacements[] = strtolower($account_type_name);

        $patterns[] = '/(\{\baccount_id\b\})/';
        $replacements[] = urlencode($account_id);

        $resource = preg_replace($patterns, $replacements, $resource);

        try {
            $response = $this->client->request('GET', $resource, [
                'headers' => [
                    'X-Target-Environment' => $this->getEnvironment(),
                ],
            ]);

            $body = json_decode($response->getBody(), true);

            return (bool) $body['result'];
        } catch (RequestException $ex) {
            throw new CollectionRequestException('Unable to get user account information.', 0, $ex);
        }
    }
}
