<?php
namespace Bmatovu\MtnMomo\Tests\Products;

use GuzzleHttp\Psr7\Response;
use Bmatovu\MtnMomo\Tests\TestCase;
use Bmatovu\MtnMomo\Products\Product;
use Bmatovu\MtnMomo\Products\Remittance;

/**
 * @see \Bmatovu\MtnMomo\Products\Remittance
 */
class RemittanceTest extends TestCase
{
    public function test_remittance_extends_product()
    {
        $remittance = new Remittance();

        $this->assertInstanceOf(Product::class, $remittance);
    }

    public function test_get_token()
    {
        $body = [
            'access_token' => str_random(60),
            'token_type' => 'Bearer',
            'expires_in' => 3600,
        ];

        $response = new Response(200, [], json_encode($body));

        $mockClient = $this->mockGuzzleClient($response);

        $remittance = new Remittance([], [], $mockClient);

        $token = $remittance->getToken();

        $this->assertEquals($token, $body);
    }

}
