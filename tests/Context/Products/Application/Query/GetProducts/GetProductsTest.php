<?php

declare(strict_types=1);

namespace App\Tests\Context\Products\Domain\ValueObject;

use App\Context\Products\Application\Query\GetProducts\GetProducts;
use PHPUnit\Framework\TestCase;

final class GetProductsTest extends TestCase
{
    public function testConstructSuccess(): void
    {
        $query = new GetProducts(0, 10);

        $this->assertEquals(0, $query->page());
        $this->assertEquals(10, $query->limit());
        $this->assertEquals(10, $query->limit());
    }
}
