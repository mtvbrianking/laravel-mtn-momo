<?php

namespace Bmatovu\MtnMomo\Http\GrantType;

use GuzzleHttp\ClientInterface;
use Bmatovu\MtnMomo\Http\GrantTypeInterface;

class ClientCredentials implements GrantTypeInterface
{
    /**
     * The token endpoint client.
     *
     * @var \GuzzleHttp\ClientInterface
     */
    private $client;

    /**
     * Configuration settings.
     *
     * @var array
     */
    private $config;

    /**
     * @param \GuzzleHttp\ClientInterface $client
     * @param array $config
     * @throws \Exception
     */
    public function __construct(ClientInterface $client, array $config)
    {
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
        $response = $this->client->request('POST', $this->config['token_uri'], [
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
