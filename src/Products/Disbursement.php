<?php

/**
 * Disbursement service/product.
 */

namespace Bmatovu\MtnMomo\Products;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;
use Illuminate\Container\Container;
use Illuminate\Contracts\Config\Repository;

/**
 * Class Disbursement
 * @package Bmatovu\MtnMomo\Products
 */
class Disbursement extends Product
{

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
    public function getToken(){

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



}