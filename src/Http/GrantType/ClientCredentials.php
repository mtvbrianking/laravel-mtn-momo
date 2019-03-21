<?php

namespace Bmatovu\MtnMomo\Http\GrantType;

use Monolog\Logger;
use GuzzleHttp\Middleware;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\MessageFormatter;
use Monolog\Handler\StreamHandler;
use Bmatovu\MtnMomo\Http\GrantTypeInterface;

class ClientCredentials implements GrantTypeInterface
{
    /**
     * The token endpoint client.
     *
     * @var ClientInterface
     */
    private $client;

    /**
     * Configuration settings.
     *
     * @var Collection
     */
    private $config;

    /**
     * @param ClientInterface $client
     * @param array           $config
     */
    public function __construct(ClientInterface $client, array $config)
    {

        // .....................
        // Add logger...

        $logger = new Logger('Logger');
        $logger->pushHandler(new StreamHandler(storage_path('logs/mtn-momo.log')), Logger::DEBUG);

        $client->getConfig('handler')->push(Middleware::log(
                $logger,
                new MessageFormatter("\r\n[Request] >>>>> {request}. [Response] >>>>> \r\n{response}.")
        ));

        // .....................

        $this->client = $client;

        $this->config = array_merge([
            'token_uri' => '',
        ], $config);
    }

    /**
     * {@inheritdoc}
     */
    public function getToken($grantType = 'client_credentials', $refreshToken = null)
    {
        $response = $this->client->post($this->config['token_uri'], [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic '.base64_encode($this->config['client_id'].':'.$this->config['client_secret']),
            ],
            'json' => [
                'grant_type' => 'client_credentials',
            ],
        ]);

        return json_decode($response->getBody());
    }
}
