<?php

declare(strict_types=1);

namespace App\Tests\Context\Products\Domain\ValueObject;

use App\Context\Elasticsearch\Domain\Filter;
use App\Context\Products\Application\Query\GetProducts\GetProducts;
use PHPUnit\Framework\TestCase;

final class GetProductsTest extends TestCase
{
    public function testConstructSuccess(): void
    {
        $filter = new Filter([]);
        $query = new GetProducts($filter, 10, 'default');

        $this->assertEquals($filter, $query->filter());
        $this->assertEquals(10, $query->page());
    }
}
