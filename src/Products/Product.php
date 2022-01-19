<?php
/**
 * Product.
 */

namespace Bmatovu\MtnMomo\Products;

use Bmatovu\MtnMomo\Repositories\TokenRepository;
use Bmatovu\OAuthNegotiator\GrantTypes\ClientCredentials;
use Bmatovu\OAuthNegotiator\OAuth2Middleware;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Illuminate\Container\Container;
use Illuminate\Contracts\Config\Repository;

/**
 * Generic product/service.
 */
abstract class Product
{
    /**
     * Product.
     *
     * @var string
     */
    const PRODUCT = null;

    /**
     * Configuration.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * HTTP client.
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * Base URI.
     *
     * @var string
     */
    protected $baseUri;

    /**
     * Token URI.
     *
     * @var string
     */
    protected $tokenUri;

    /**
     * Subscription key.
     *
     * @var string
     */
    protected $subscriptionKey;

    /**
     * Client ID.
     *
     * @var string
     */
    protected $clientId;

    /**
     * Client secret.
     *
     * @var string
     */
    protected $clientSecret;

    /**
     * Client callback URI.
     *
     * @var string
     */
    protected $clientCallbackUri;

    /**
     * Currency.
     *
     * @var string
     */
    protected $currency;

    /**
     * Environment.
     *
     * @var string
     */
    protected $environment;

    /**
     * Party ID type.
     *
     * @var string
     */
    protected $partyIdType;

    /**
     * Log file.
     *
     * @var string
     */
    protected $logFile;

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param \GuzzleHttp\ClientInterface $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * @param string $baseUri
     */
    public function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;
    }

    /**
     * @return string
     */
    public function getTokenUri()
    {
        return $this->tokenUri;
    }

    /**
     * @param string $tokenUri
     */
    public function setTokenUri($tokenUri)
    {
        $this->tokenUri = $tokenUri;
    }

    /**
     * @return string
     */
    public function getSubscriptionKey()
    {
        return $this->subscriptionKey;
    }

    /**
     * @param string $subscriptionKey
     */
    public function setSubscriptionKey($subscriptionKey)
    {
        $this->subscriptionKey = $subscriptionKey;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return string
     */
    public function getClientCallbackUri()
    {
        return $this->clientCallbackUri;
    }

    /**
     * @param string $clientCallbackUri
     */
    public function setClientCallbackUri($clientCallbackUri)
    {
        $this->clientCallbackUri = $clientCallbackUri;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @param string $environment
     */
    public function setEnvironment($environment)
    {
        $this->environment = $environment;
    }

    /**
     * @return string
     */
    public function getPartyIdType()
    {
        return $this->partyIdType;
    }

    /**
     * @param string $partyIdType
     */
    public function setPartyIdType($partyIdType)
    {
        $this->partyIdType = $partyIdType;
    }

    /**
     * @return string
     */
    public function getLogFile()
    {
        return $this->logFile;
    }

    /**
     * @param string $logFile
     */
    public function setLogFile($logFile)
    {
        $this->logFile = $logFile;
    }

    /**
     * Constructor.
     *
     * @param array $headers
     * @param array $middleware
     * @param \GuzzleHttp\ClientInterface $client
     *
     * @throws \Exception
     */
    public function __construct($headers = [], $middleware = [], ClientInterface $client = null)
    {
        $this->config = Container::getInstance()->make(Repository::class);

        // Set defaults.
        $this->setConfigurations();

        if ($client) {
            $this->client = $client;

            return;
        }

        // Guzzle http request headers.
        $headers = array_merge([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Ocp-Apim-Subscription-Key' => $this->subscriptionKey,
        ], $headers);

        // Guzzle http client middleware.

        $handlerStack = HandlerStack::create();

        foreach ($middleware as $mw) {
            $handlerStack->push($mw);
        }

        $handlerStack->push($this->getAuthBroker($headers));

        $handlerStack = append_log_middleware($handlerStack);

        $options = array_merge([
            'handler' => $handlerStack,
            'base_uri' => $this->baseUri,
            'headers' => $headers,
        ], $this->config->get('mtn-momo.guzzle.options'));

        // Set http client.
        $this->client = new Client($options);
    }

    /**
     * Request access token.
     *
     * @return array
     */
    abstract public function getToken();

    /**
     * Setup default configurations.
     *
     * @uses \Illuminate\Contracts\Config\Repository
     *
     * @return void
     */
    private function setConfigurations()
    {
        $this->baseUri = $this->config->get('mtn-momo.api.base_uri');
        $this->currency = $this->config->get('mtn-momo.currency');
        $this->environment = $this->config->get('mtn-momo.environment');
        $this->logFile = $this->config->get('mtn-momo.log');
    }

    /**
     * Get authentication broker.
     *
     * @link https://momodeveloper.mtn.com/api-documentation/api-description/#oauth-2-0 Documentation
     *
     * @param  array $headers HTTP request headers
     *
     * @throws \Exception
     *
     * @return \Bmatovu\OAuthNegotiator\OAuth2Middleware
     */
    protected function getAuthBroker($headers)
    {
        $handlerStack = HandlerStack::create();

        $handlerStack = append_log_middleware($handlerStack);

        $options = array_merge([
            'base_uri' => $this->baseUri,
            'handler' => $handlerStack,
            'headers' => $headers,
            'json' => [
                'body',
            ],
        ], $this->config->get('mtn-momo.guzzle.options'));

        // Authorization client - this is used to request OAuth access tokens
        $client = new Client($options);

        $config = [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'token_uri' => $this->tokenUri,
        ];

        // This grant type is used to get a new Access Token and,
        // Refresh Token when no valid Access Token or Refresh Token is available
        $clientCredGrant = new ClientCredentials($client, $config);

        // Create token repository
        $tokenRepo = new TokenRepository(static::PRODUCT);

        // Tell the middleware to use both the client and refresh token grants
        return new OAuth2Middleware($clientCredGrant, null, $tokenRepo);
    }
}
