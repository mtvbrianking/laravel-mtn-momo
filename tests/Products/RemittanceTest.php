<?php
namespace Bmatovu\MtnMomo\Tests\Products;

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
}
