<?php
/**
 * Remittance.
 */

namespace Bmatovu\MtnMomo\Products;

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
     * @link https://momodeveloper.mtn.com/docs/services/remittance/operations/token-POST Documentation
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
}
