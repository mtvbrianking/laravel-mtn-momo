<?php

namespace Bmatovu\MtnMomo\Tests\Products;


use Ramsey\Uuid\Uuid;
use GuzzleHttp\Psr7\Response;
use Bmatovu\MtnMomo\Tests\TestCase;
use Bmatovu\MtnMomo\Products\Product;
use Bmatovu\MtnMomo\Products\Disbursement;
use GuzzleHttp\Exception\RequestException;
use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;

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

        $response = new Response(202, [], null);

        $mockClient = $this->mockGuzzleClient($response);

        $disbursement = new Disbursement([], [], $mockClient);

        $this->assertInstanceOf(Product::class, $disbursement);

        $transaction_ref = $disbursement->transfer('EXT_REF_ID', '07XXXXXXXX', 100);

        $this->assertTrue(Uuid::isValid($transaction_ref));

    }

    public function test_throws_previous_transfer_disbursement_request_exception()
    {
        $response = new Response(400, [], null);

        $mockClient = $this->mockGuzzleClient($response);

        $disbursement = new Disbursement([], [], $mockClient);

        $this->assertInstanceOf(Product::class, $disbursement);

        try {
            $transaction_ref = $disbursement->transfer('EXT_REF_ID', '07XXXXXXXX', 100);
            $this->assertNull($transaction_ref);
        } catch(CollectionRequestException $e) {
            $this->assertInstanceOf(CollectionRequestException::class, $e);
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

        $disbursement = new Disbursement([], [], $mockClient);

        $treansaction_ref = Uuid::uuid4()->toString();

        $transaction = $disbursement->getDisbursementTransactionStatus($treansaction_ref);

        $this->assertEquals($transaction, $body);
    }



}
