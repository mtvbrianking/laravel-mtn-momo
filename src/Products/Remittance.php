<?php
/**
 * Remittance.
 */

namespace Bmatovu\MtnMomo\Products;

use Ramsey\Uuid\Uuid;
use GuzzleHttp\ClientInterface;
use Illuminate\Container\Container;
use Illuminate\Contracts\Config\Repository;

/**
 * Remittance service/product.
 */
class Remittance extends Product
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
     * @param \GuzzleHttp\ClientInterface $client
     *
     * @uses \Illuminate\Contracts\Config\Repository
     *
     * @throws \Exception
     */
    public function __construct($headers = [], $middlewares = [], ClientInterface $client = null)
    {
        $config = Container::getInstance()->make(Repository::class);

        $this->subscriptionKey = $config->get('mtn-momo.products.remittance.key');
        $this->clientId = $config->get('mtn-momo.products.remittance.id');
        $this->clientSecret = $config->get('mtn-momo.products.remittance.secret');
        $this->clientRedirectUri = $config->get('mtn-momo.products.remittance.redirect_uri');

        $this->tokenUri = $config->get('mtn-momo.products.remittance.token_uri');
        $this->transactUri = $config->get('mtn-momo.products.remittance.transact_uri');
        $this->transactionStatusUri = $config->get('mtn-momo.products.remittance.transaction_status_uri');
        $this->userAccountUri = $config->get('mtn-momo.products.remittance.user_account_uri');
        $this->appAccountBalanceUri = $config->get('mtn-momo.products.remittance.app_account_balance_uri');
        $this->partyIdType = $config->get('mtn-momo.products.remittance.party_id_type');

        parent::__construct($headers, $middlewares, $client);
    }

    /**
     * Request remittance access token.
     *
     * @see https://momodeveloper.mtn.com/docs/services/remittance/operations/token-POST Documentation
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\RemittanceRequestException
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
            throw new RemittanceRequestException('Unable to get token.', 0, $ex);
        }
    }

    /**
     * Transfer from your own account to another person's account.
     *
     * @see https://momodeveloper.mtn.com/docs/services/remittance/operations/transfer-POST Documentation
     *
     * @param string $int_trans_id  Your internal transaction reference ID.
     * @param string $party_id      Account holder. Usually phone number if type is MSISDN.
     * @param int    $amount        How much to credit the payer.
     * @param string $payer_message Payer transaction message.
     * @param string $payee_note    Payee transaction message.
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\RemittanceRequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     *
     * @return string Auto generated transaction reference. Format: UUID
     */
    public function transact($int_trans_id, $party_id, $amount, $payer_message = '', $payee_note = '')
    {
        $ext_trans_id = Uuid::uuid4()->toString();

        $headers = [
            'X-Reference-Id' => $ext_trans_id,
            'X-Target-Environment' => $this->environment,
        ];

        if ($this->environment != 'sandbox') {
            $headers['X-Callback-Url'] = $this->clientRedirectUri;
        }

        try {
            $this->client->request('POST', $this->transactUri, [
                'headers' => $headers,
                'json' => [
                    'amount' => $amount,
                    'currency' => $this->currency,
                    'externalId' => $int_trans_id,
                    'payer' => [
                        'partyIdType' => $this->partyIdType,
                        'partyId' => $party_id,
                    ],
                    'payerMessage' => $payer_message,
                    'payeeNote' => $payee_note,
                ],
            ]);

            return $ext_trans_id;
        } catch (RequestException $ex) {
            throw new RemittanceRequestException('Request to pay transaction - unsuccessful.', 0, $ex);
        }
    }

    /**
     * Transfer from your own account to another person's account.
     *
     * @see Remittance::transact
     * @see https://momodeveloper.mtn.com/docs/services/remittance/operations/transfer-POST Documentation
     *
     * @param string $int_trans_id  Your internal transaction reference ID.
     * @param string $party_id      Account holder. Usually phone number if type is MSISDN.
     * @param int    $amount        How much to credit the payer.
     * @param string $payer_message Payer transaction message.
     * @param string $payee_note    Payee transaction message.
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\RemittanceRequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     *
     * @return string Auto generated transaction reference. Format: UUID
     */
    public function transfer($int_trans_id, $party_id, $amount, $payer_message = '', $payee_note = '')
    {
        return $this->transact($int_trans_id, $party_id, $amount, $payer_message, $payee_note);
    }

    /**
     * Get transaction status.
     *
     * @see https://momodeveloper.mtn.com/docs/services/remittance/operations/transfer-referenceId-GET Documentation
     *
     * @param  string $payment_ref That was returned by transact (requestToPay)
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\RemittanceRequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return array
     */
    public function getTransactionStatus($payment_ref)
    {
        $transaction_status_uri = str_replace('{transaction_id}', $payment_ref, $this->transactionStatusUri);

        try {
            $response = $this->client->request('GET', $transaction_status_uri, [
                'headers' => [
                    'X-Target-Environment' => $this->environment,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $ex) {
            throw new RemittanceRequestException('Unable to get transaction status.', 0, $ex);
        }
    }

    /**
     * Get account balance.
     *
     * @see https://momodeveloper.mtn.com/docs/services/remittance/operations/get-v1_0-account-balance Documentation
     *
     * @throws \Bmatovu\MtnMomo\Exceptions\RemittanceRequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return array Account balance.
     */
    public function getAccountBalance()
    {
        try {
            $response = $this->client->request('GET', $this->appAccountBalanceUri, [
                'headers' => [
                    'X-Target-Environment' => $this->environment,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $ex) {
            throw new RemittanceRequestException('Unable to get account balance.', 0, $ex);
        }
    }
}
