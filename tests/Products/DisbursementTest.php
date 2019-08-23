<?php

namespace Bmatovu\MtnMomo\Tests\Products;

use GuzzleHttp\Psr7\Response;
use Bmatovu\MtnMomo\Tests\TestCase;
use Bmatovu\MtnMomo\Products\Product;
use Bmatovu\MtnMomo\Products\Disbursement;

/**
 * @see \Bmatovu\MtnMomo\Products\Disbursement
 */
class DisbursementTest extends TestCase
{
    /**
     * Test Disbursement extends Product
     *
     * @throws \Exception
     */
    public function test_disbursement_extends_product()
    {
        $disburse = new Disbursement();

        $this->assertInstanceOf(Product::class, $disburse);
    }

    /**
     * test create access token
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @throws \Exception
     */
    public function test_create_accessToken()
    {
        $body = [
            'access_token' => str_random(60),
            'token_type' => 'Bearer',
            'expires_in' => 3600,
        ];

        $response =new Response(200, [],json_encode($body));

        $mockclient = $this->mockGuzzleClient($response);

        $disbursement = new Disbursement([],[],$mockclient);

        $token=$disbursement->getToken();

        $this->assertEquals($token,$body);
    }

    public function test_transfer_operation(){

    }


}
