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
}
