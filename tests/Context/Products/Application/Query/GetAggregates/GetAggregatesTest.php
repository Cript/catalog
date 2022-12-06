<?php

declare(strict_types=1);

namespace App\Tests\Context\Products\Application\Query\GetAggregates;

use App\Context\Products\Application\Query\Filter;
use App\Context\Products\Application\Query\GetAggregates\GetAggregates;
use PHPUnit\Framework\TestCase;

final class GetAggregatesTest extends TestCase
{
    public function testConstructSuccess(): void
    {
        $filter = new Filter([]);
        $query = new GetAggregates($filter);

        $this->assertEquals($filter, $query->filter());
    }
}
