<?php
namespace Bmatovu\MtnMomo\Tests\Products;

use Mockery as m;
use Ramsey\Uuid\Uuid;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\ClientInterface;
use Bmatovu\MtnMomo\Tests\TestCase;
use Illuminate\Container\Container;
use Bmatovu\MtnMomo\Products\Product;
use Illuminate\Contracts\Console\Kernel;
use Bmatovu\MtnMomo\Products\Collection;
use GuzzleHttp\Exception\RequestException;
use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;

/**
 * @see \Bmatovu\MtnMomo\Products\Collection
 */
class CollectionTest extends TestCase
{
    public function test_collection_extends_product()
    {
        $collection = new Collection();

        $this->assertInstanceOf(Product::class, $collection);
    }

    public function test_can_transact()
    {
        $response = new Response(202, [], null);

        $mockClient = $this->mockGuzzleClient($response);

        $collection = new Collection([], [], $mockClient);

        $this->assertInstanceOf(Product::class, $collection);

        $momoTransactionId = $collection->transact('transactionId', '07XXXXXXXX', 100);

        $this->assertTrue(Uuid::isValid($momoTransactionId));
    }

    public function test_throws_transact_collection_request_exception()
    {
        $response = new Response(400, [], null);

        $mockClient = $this->mockGuzzleClient($response);

        $collection = new Collection([], [], $mockClient);

        $this->assertInstanceOf(Product::class, $collection);

        $this->expectException(CollectionRequestException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('Request to pay transaction - unsuccessful.');

        $momoTransactionId = $collection->transact('transactionId', '07XXXXXXXX', 100);

        $this->assertNull($momoTransactionId);
    }

    public function test_throws_previous_transact_collection_request_exception()
    {
        $response = new Response(400, [], null);

        $mockClient = $this->mockGuzzleClient($response);

        $collection = new Collection([], [], $mockClient);

        $this->assertInstanceOf(Product::class, $collection);

        try {
            $momoTransactionId = $collection->transact('transactionId', '07XXXXXXXX', 100);
            $this->assertNull($momoTransactionId);
        } catch(CollectionRequestException $e) {
            $this->assertInstanceOf(CollectionRequestException::class, $e);
            $this->assertEquals($e->getCode(), 0);
            $this->assertEquals('Request to pay transaction - unsuccessful.', $e->getMessage());

            $pex = $e->getPrevious();

            $this->assertInstanceOf(RequestException::class, $pex);
            $this->assertEquals($pex->getCode(), 400);
        }
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

        $collection = new Collection([], [], $mockClient);

        $momoTransactionId = Uuid::uuid4()->toString();

        $transaction = $collection->getTransactionStatus($momoTransactionId);

        $this->assertEquals($transaction, $body);
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

        $collection = new Collection([], [], $mockClient);

        $token = $collection->getToken();

        $this->assertEquals($token, $body);
    }

    public function test_get_account_balance()
    {
        $body = [
            'availableBalance' => 100,
            'currency' => 'EUR'
        ];

        $response = new Response(200, [], json_encode($body));

        $mockClient = $this->mockGuzzleClient($response);

        $collection = new Collection([], [], $mockClient);

        $accountBal = $collection->getAccountBalance();

        $this->assertEquals($accountBal, $body);
    }

    public function test_can_determine_account_status()
    {
        $body = [
            'result' => true
        ];

        $response = new Response(200, [], json_encode($body));

        $mockClient = $this->mockGuzzleClient($response);

        $collection = new Collection([], [], $mockClient);

        $isActive = $collection->isActive('07XXXXXXXX');

        $this->assertTrue($isActive);
    }
}
