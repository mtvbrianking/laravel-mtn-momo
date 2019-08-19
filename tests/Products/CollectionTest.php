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

        $payment_ref = $collection->transact('EXT_REF_ID', '07XXXXXXXX', 100);

        $this->assertTrue(Uuid::isValid($payment_ref));
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

        $payment_ref = $collection->transact('EXT_REF_ID', '07XXXXXXXX', 100);

        $this->assertNull($payment_ref);
    }

    public function test_throws_previous_transact_collection_request_exception()
    {
        $response = new Response(400, [], null);

        $mockClient = $this->mockGuzzleClient($response);

        $collection = new Collection([], [], $mockClient);

        $this->assertInstanceOf(Product::class, $collection);

        try {
            $payment_ref = $collection->transact('EXT_REF_ID', '07XXXXXXXX', 100);
            $this->assertNull($payment_ref);
        } catch(CollectionRequestException $e) {
            $this->assertInstanceOf(CollectionRequestException::class, $e);
            $this->assertEquals($e->getCode(), 0);
            $this->assertEquals('Request to pay transaction - unsuccessful.', $e->getMessage());

            $pex = $e->getPrevious();

            $this->assertInstanceOf(RequestException::class, $pex);
            $this->assertEquals($pex->getCode(), 400);
        }
    }
}
