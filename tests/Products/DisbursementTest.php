<?php

namespace Bmatovu\MtnMomo\Tests\Products;

use Bmatovu\MtnMomo\Exceptions\DisbursementRequestException;
use Bmatovu\MtnMomo\Products\Disbursement;
use Bmatovu\MtnMomo\Products\Product;
use Bmatovu\MtnMomo\Tests\TestCase;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

/**
 * @see \Bmatovu\MtnMomo\Products\Disbursement
 */
class DisbursementTest extends TestCase
{
    public function test_disbursement_extends_product()
    {
        $disbursement = new Disbursement();

        $this->assertInstanceOf(Product::class, $disbursement);
    }

    public function test_create_accessToken()
    {
        $body = [
            'access_token' => Str::random(60),
            'token_type' => 'Bearer',
            'expires_in' => 3600,
        ];

        $response =new Response(200, [], json_encode($body));

        $mockClient = $this->mockGuzzleClient($response);

        $disbursement = new Disbursement([], [], $mockClient);

        $token = $disbursement->getToken();

        $this->assertEquals($token, $body);
    }

    public function test_can_transfer()
    {
        $response = new Response(202, [], null);

        $mockClient = $this->mockGuzzleClient($response);

        $disbursement = new Disbursement([], [], $mockClient);

        $this->assertInstanceOf(Product::class, $disbursement);

        $momoTransactionId = $disbursement->transfer('transactionId', '07XXXXXXXX', 100);

        $this->assertTrue(Uuid::isValid($momoTransactionId));
    }

    public function test_throws_previous_transfer_disbursement_request_exception()
    {
        $response = new Response(400, [], null);

        $mockClient = $this->mockGuzzleClient($response);

        $disbursement = new Disbursement([], [], $mockClient);

        $this->assertInstanceOf(Product::class, $disbursement);

        try {
            $momoTransactionId = $disbursement->transfer('transactionId', '07XXXXXXXX', 100);
            $this->assertNull($momoTransactionId);
        } catch (DisbursementRequestException $e) {
            $this->assertInstanceOf(DisbursementRequestException::class, $e);
            $this->assertEquals($e->getCode(), 0);
            $this->assertEquals('Request to transfer transaction - unsuccessful.', $e->getMessage());

            $pex = $e->getPrevious();

            $this->assertInstanceOf(RequestException::class, $pex);
            $this->assertEquals($pex->getCode(), 400);
        }
    }

    public function test_check_transfer_transaction_status()
    {
        $body = [
            'amount' => 100,
            'currency' => 'UGX',
            'externalId' => 947354,
            'payee' => [
                'partyIdType' => 'MSISDN',
                'partyId' => 4656473839,
            ],
            'status' => 'FAILED',
            'reason' => [
                'code' => 'PAYER_NOT_FOUND',
                'message' => 'Payee does not exist',
            ],
        ];

        $response = new Response(200, [], json_encode($body));

        $mockClient = $this->mockGuzzleClient($response);

        $disbursement = new Disbursement([], [], $mockClient);

        $ext_trans_ref = Uuid::uuid4()->toString();

        $transaction = $disbursement->getTransactionStatus($ext_trans_ref);

        $this->assertEquals($transaction, $body);
    }

    public function test_disbursement_get_account_balance()
    {
        $body = [
            'availableBalance' => 100,
            'currency' => 'EUR',
        ];

        $response = new Response(200, [], json_encode($body));

        $mockClient = $this->mockGuzzleClient($response);

        $disbursement = new Disbursement([], [], $mockClient);

        $accountBal = $disbursement->getAccountBalance();

        $this->assertEquals($accountBal, $body);
    }

    public function test_disbursement_can_determine_account_status()
    {
        $body = [
            'result' => true,
        ];

        $response = new Response(200, [], json_encode($body));

        $mockClient = $this->mockGuzzleClient($response);

        $disbursement = new Disbursement([], [], $mockClient);

        $isActive = $disbursement->isActive('07XXXXXXXX');

        $this->assertTrue($isActive);
    }
}
