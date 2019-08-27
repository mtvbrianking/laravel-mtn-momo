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

        $momoTransactionId = $remittance->transact('transactionId', '07XXXXXXXX', 100);

        $this->assertTrue(Uuid::isValid($momoTransactionId));
    }

    public function test_can_tranfer()
    {
        $response = new Response(202, [], null);

        $mockClient = $this->mockGuzzleClient($response);

        $remittance = new Remittance([], [], $mockClient);

        $momoTransactionId = $remittance->transfer('transactionId', '07XXXXXXXX', 100);

        $this->assertTrue(Uuid::isValid($momoTransactionId));
    }

    public function test_check_transaction_status()
    {
        $body = [
            'amount' => 100,
            'currency' => 'UGX',
            'externalId' => 947354,
            'payee' => [
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

        $momoTransactionId = Uuid::uuid4()->toString();

        $transaction = $remittance->getTransactionStatus($momoTransactionId);

        $this->assertEquals($transaction, $body);
    }

    public function test_get_account_balance()
    {
        $body = [
            'availableBalance' => 100,
            'currency' => 'EUR'
        ];

        $response = new Response(200, [], json_encode($body));

        $mockClient = $this->mockGuzzleClient($response);

        $remittance = new Remittance([], [], $mockClient);

        $accountBal = $remittance->getAccountBalance();

        $this->assertEquals($accountBal, $body);
    }

    public function test_can_determine_if_account_is_active()
    {
        $body = [
            'result' => true
        ];

        $response = new Response(200, [], json_encode($body));

        $mockClient = $this->mockGuzzleClient($response);

        $remittance = new Remittance([], [], $mockClient);

        $isActive = $remittance->isActive('07XXXXXXXX');

        $this->assertTrue($isActive);
    }
}
