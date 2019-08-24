<?php
namespace Bmatovu\MtnMomo\Tests\Products;

use Ramsey\Uuid\Uuid;
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

    public function test_can_get_token()
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

    public function test_can_transact()
    {
        $response = new Response(202, [], null);

        $mockClient = $this->mockGuzzleClient($response);

        $remittance = new Remittance([], [], $mockClient);

        $ext_trans_ref = $remittance->transact('int_trans_id', '07XXXXXXXX', 100);

        $this->assertTrue(Uuid::isValid($ext_trans_ref));
    }

    public function test_can_tranfer()
    {
        $response = new Response(202, [], null);

        $mockClient = $this->mockGuzzleClient($response);

        $remittance = new Remittance([], [], $mockClient);

        $ext_trans_ref = $remittance->transfer('int_trans_id', '07XXXXXXXX', 100);

        $this->assertTrue(Uuid::isValid($ext_trans_ref));
    }

    public function test_check_transaction_status()
    {
        $body = [
            'amount' => 100,
            'currency' => 'UGX',
            'externalId' => 947354,
            'payer' => [
                'partyIdType' => 'MSISDN',
                'partyId' => 4656473839
            ],
            'status' => 'FAILED',
            'reason' => [
                'code' => 'PAYER_NOT_FOUND',
                'message' => 'Payee does not exist'
            ]
        ];

        $response = new Response(200, [], json_encode($body));

        $mockClient = $this->mockGuzzleClient($response);

        $remittance = new Remittance([], [], $mockClient);

        $ext_trans_ref = Uuid::uuid4()->toString();

        $transaction = $remittance->getTransactionStatus($ext_trans_ref);

        $this->assertEquals($transaction, $body);
    }
}
