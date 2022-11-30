<?php

namespace App\Context\Products\Application\Query\GetProducts;

use App\Context\Products\Domain\ProductRepositoryInterface;
use App\Context\Shared\Application\Bus\Query\QueryHandlerInterface;

final class GetProductsHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly ProductRepositoryInterface $repository
    ) {}

    public function __invoke(GetProducts $query): array
    {
        dd($query);

        $products = $this->repository->load($query->page(), $query->limit(), $query->categoryId());

        return $products;
    }
}
