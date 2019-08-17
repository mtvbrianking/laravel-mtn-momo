<?php
/**
 * Product.
 */

namespace Bmatovu\MtnMomo\Products;

use Monolog\Logger;
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\MessageFormatter;
use Monolog\Handler\StreamHandler;
use Illuminate\Container\Container;
use Illuminate\Contracts\Config\Repository;
use Bmatovu\OAuthNegotiator\OAuth2Middleware;
use Bmatovu\MtnMomo\Repositories\TokenRepository;
use Bmatovu\OAuthNegotiator\GrantTypes\ClientCredentials;

/**
 * Class Product.
 */
abstract class Product
{
    /**
     * HTTP client.
     *
     * @var \GuzzleHttp\Client
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
     * Client redirect URI.
     *
     * @var string
     */
    protected $clientRedirectUri;

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
    public function getsubscriptionKey()
    {
        return $this->subscriptionKey;
    }

    /**
     * @param string $subscriptionKey
     */
    public function setsubscriptionKey($subscriptionKey)
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
    public function getClientRedirectUri()
    {
        return $this->clientRedirectUri;
    }

    /**
     * @param string $clientRedirectUri
     */
    public function setClientRedirectUri($clientRedirectUri)
    {
        $this->clientRedirectUri = $clientRedirectUri;
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
     * @param array $middlewares
     * @param \GuzzleHttp\ClientInterface $client
     *
     * @throws \Exception
     */
    public function __construct($headers = [], $middlewares = [], ClientInterface $client = null)
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
            'Ocp-Apim-Subscription-Key' => $this->getsubscriptionKey(),
        ], $headers);

        // Guzzle http client middleware.

        $handlerStack = HandlerStack::create();

        foreach ($middlewares as $middleware) {
            $handlerStack->push($middleware);
        }

        $handlerStack->push($this->getAuthBroker($headers));

        if ($this->config->get('app.debug')) {
            $handlerStack->push($this->getLogMiddleware());
        }

        // Set http client.
        $this->client = new Client([
            'handler' => $handlerStack,
            'base_uri' => $this->getBaseUri(),
            'headers' => $headers,
        ]);
    }

    /**
     * Request access token.
     *
     * @throws \GuzzleHttp\Exception\RequestException;
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
        $this->setBaseUri($this->config->get('mtn-momo.api.base_uri'));
        $this->setCurrency($this->config->get('mtn-momo.currency'));
        $this->setEnvironment($this->config->get('mtn-momo.environment'));
        $this->setLogFile('mtn-momo.log');
    }

    /**
     * Get log middleware.
     *
     * @return callable
     */
    protected function getLogMiddleware()
    {
        $logger = new Logger('Logger');
        $streamHandler = new StreamHandler(storage_path('logs/'.$this->getLogFile()));
        $logger->pushHandler($streamHandler);
        $messageFormatter = new MessageFormatter("\r\n[Request] {request} \r\n[Response] {response} \r\n[Error] {error}.");

        return Middleware::log($logger, $messageFormatter);
    }

    /**
     * Get authentication broker.
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

        if ($this->config->get('app.debug')) {
            $handlerStack->push($this->getLogMiddleware());
        }

        // Authorization client - this is used to request OAuth access tokens
        $client = new Client([
            'base_uri' => $this->getBaseUri(),
            'handler' => $handlerStack,
            'headers' => $headers,
            'json' => [
                'body',
            ],
        ]);

        $config = [
            'client_id' => $this->getClientId(),
            'client_secret' => $this->getClientSecret(),
            'token_uri' => $this->getTokenUri(),
        ];

        // This grant type is used to get a new Access Token and,
        // Refresh Token when no valid Access Token or Refresh Token is available
        $client_grant = new ClientCredentials($client, $config);

        // Create token repository
        $tokenRepo = new TokenRepository();

        // Tell the middleware to use both the client and refresh token grants
        return new OAuth2Middleware($client_grant, null, $tokenRepo);
    }
}
