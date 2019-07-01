<?php
/**
 * Collection.
 */

namespace Bmatovu\MtnMomo\Products;

use Ramsey\Uuid\Uuid;
use Illuminate\Container\Container;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Contracts\Config\Repository;
use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;

/**
 * Class Collection.
 */
class Collection extends Product
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
     * Constructor.
     *
     * @param array $headers
     * @param array $middlewares
     *
     * @uses \Illuminate\Contracts\Config\Repository
     *
     * @throws \Exception
     */
    public function __construct($headers = [], $middlewares = [])
    {
        $config = Container::getInstance()->make(Repository::class);

        $this->setTokenUri($config->get('mtn-momo.products.collection.token_uri'));
        $this->setTransactUri($config->get('mtn-momo.products.collection.transact_uri'));
        $this->setTransactionStatusUri($config->get('mtn-momo.products.collection.transaction_status_uri'));
        $this->setUserAccountUri($config->get('mtn-momo.products.collection.user_account_uri'));
        $this->setAppAccountBalanceUri($config->get('mtn-momo.products.collection.app_account_balance_uri'));
        $this->setPartyIdType($config->get('mtn-momo.products.collection.party_id_type'));

        parent::__construct($headers, $middlewares);
    }

    /**
     * Request payee to pay.
     *
     * @see https://momodeveloper.mtn.com/docs/services/collection/operations/requesttopay-POST Documentation
     *
     * @param  string $external_id   Transaction reference ID.
     * @param  string $party_id      Account holder. Usually phone number if type is MSISDN.
     * @param  int    $amount        How much to debit the payer.
     * @param  string $payer_message Payer transaction history message.
     * @param  string $payee_note    Payee transaction history message.
     *
     * @return string                Payment reference ID
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\CollectionRequestException
     */
    public function transact($external_id, $party_id, $amount, $payer_message = '', $payee_note = '')
    {
        $payment_ref = Uuid::uuid4()->toString();

        $resource = $this->getTransactUri();

        try {
            $this->client->request('POST', $resource, [
                'headers' => [
                    'X-Reference-Id' => $payment_ref,
                    'X-Callback-Url' => $this->getClientRedirectUri(),
                    'X-Target-Environment' => $this->getEnvironment(),
                ],
                'json' => [
                    'amount' => $amount,
                    'currency' => $this->getCurrency(),
                    'externalId' => $external_id,
                    'payer' => [
                        'partyIdType' => $this->getPartyIdType(),
                        'partyId' => $party_id,
                    ],
                    'payerMessage' => $payer_message,
                    'payeeNote' => $payee_note,
                ],
            ]);

            return $payment_ref;
        } catch (RequestException $ex) {
            throw new CollectionRequestException('Unable to transact (request pay).', 0, $ex);
        }
    }

    /**
     * Get transaction status.
     *
     * @param  string $payment_ref ID
     *
     * @return array
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\CollectionRequestException
     */
    public function getTransactionStatus($payment_ref)
    {
        $resource = preg_replace('/(\{\btransaction_id\b\})$/',
            $payment_ref, $this->getTransactionStatusUri());

        try {
            $response = $this->client->request('GET', $resource, [
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
     * Request collections access token.
     *
     * @return array
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\CollectionRequestException
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
     * Get account balance.
     *
     * @return array Account balance.
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\CollectionRequestException
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
     * Get user account information.
     *
     * @param  string $account_id
     * @param  string $account_type_name
     *
     * @return array User account info
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\CollectionRequestException
     */
    public function getUserAccountInfo($account_id, $account_type_name = null)
    {
        $resource = $this->getUserAccountUri();

        if (is_null($account_type_name)) {
            $account_type_name = $this->getPartyIdType();
        }

        $patterns = $replacements = [];

        $patterns[] = '/(\{\baccount_type_name\b\})/';
        $replacements[] = strtolower($account_type_name);

        $patterns[] = '/(\{\baccount_id\b\})/';
        $replacements[] = $account_id;

        $resource = preg_replace($patterns, $replacements, $resource);

        try {
            $response = $this->client->request('GET', $resource, [
                'headers' => [
                    'X-Target-Environment' => $this->getEnvironment(),
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $ex) {
            throw new CollectionRequestException('Unable to get user account information.', 0, $ex);
        }
    }
}
