<?php

declare(strict_types=1);

namespace App\Tests\Context\Products\Application\Query\GetAggregates;

use App\Context\Products\Application\Query\Filter;
use App\Context\Products\Application\Query\GetAggregates\GetAggregates;
use App\Context\Products\Application\Query\GetAggregates\GetAggregatesHandler;
use App\Context\Products\Infrastructure\ProductIndexInMemoryRepository;
use PHPUnit\Framework\TestCase;

final class GetAggregatesHandlerTest extends TestCase
{
    private GetAggregatesHandler $handler;
    private ProductIndexInMemoryRepository $productIndexRepository;

    public function setUp(): void
    {
        $this->productIndexRepository = $this->createMock(ProductIndexInMemoryRepository::class);
        $this->handler = new GetAggregatesHandler($this->productIndexRepository);
    }

    public function testWithoutFilter()
    {
        $filter = new Filter([]);
        $query = new GetAggregates($filter);

        $this->productIndexRepository
            ->expects($this->once())
            ->method('aggregates')
            ->with($filter->all());

        $result = call_user_func($this->handler, $query);

        $this->assertArrayHasKey('default', $result->aggregates());
    }

    public function testWithOneFilter()
    {
        $filter = new Filter([
            'name' => 'product'
        ]);
        $query = new GetAggregates($filter);

        $this->productIndexRepository
            ->expects($this->exactly(2))
            ->method('aggregates')
            ->withConsecutive(
                [$filter->all()],
                [$filter->without('name')]
           );

        $result = call_user_func($this->handler, $query);

        $this->assertArrayHasKey('default', $result->aggregates());
    }
}
