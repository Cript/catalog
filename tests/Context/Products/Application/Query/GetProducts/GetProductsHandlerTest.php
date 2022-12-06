<?php

declare(strict_types=1);

namespace App\Tests\Context\Products\Application\Query\GetProducts;

use App\Context\Products\Application\Query\Filter;
use App\Context\Products\Application\Query\GetProducts\GetProducts;
use App\Context\Products\Application\Query\GetProducts\GetProductsHandler;
use App\Context\Products\Application\Query\GetProducts\Response;
use App\Context\Products\Application\Query\Sorting;
use App\Context\Products\Infrastructure\ProductIndexInMemoryRepository;
use PHPUnit\Framework\TestCase;

final class GetProductsHandlerTest extends TestCase
{
    private ProductIndexInMemoryRepository $productIndexRepository;
    private GetProductsHandler $handler;

    public function setUp(): void
    {
        $this->productIndexRepository = $this->createStub(ProductIndexInMemoryRepository::class);
        $this->handler = new GetProductsHandler($this->productIndexRepository);
    }

    public function testExecute()
    {
        $filter = new Filter([]);
        $sorting = new Sorting(null);

        $total = 100000;
        $products = [
            'id' => 'product_id'
        ];

        $this->productIndexRepository
            ->method('load')
            ->willReturn([
                'total' => $total,
                'products' => $products
            ]);

        $query = new GetProducts($filter, 0, $sorting);

        /**
         * @var Response $result
         */
        $result = call_user_func($this->handler, $query);

        $this->assertEquals($total, $result->total());
        $this->assertEquals($products, $result->products());
    }
}
