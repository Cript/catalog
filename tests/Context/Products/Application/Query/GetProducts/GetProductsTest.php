<?php

declare(strict_types=1);

namespace App\Tests\Context\Products\Application\Query\GetProducts;

use App\Context\Products\Application\Query\Filter;
use App\Context\Products\Application\Query\GetProducts\GetProducts;
use App\Context\Products\Application\Query\Sorting;
use PHPUnit\Framework\TestCase;

final class GetProductsTest extends TestCase
{
    public function testConstructSuccess(): void
    {
        $filter = new Filter([]);
        $sorting = new Sorting('default');
        $query = new GetProducts($filter, 10, $sorting);

        $this->assertEquals($filter, $query->filter());
        $this->assertEquals(10, $query->page());
        $this->assertEquals(10, $query->perPage());
        $this->assertEquals($sorting, $query->sorting());
    }
}
