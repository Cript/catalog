<?php

namespace App\Context\Products\Application\Query\GetProducts;

use App\Context\Products\Domain\RepositoryInterface;
use App\Context\Shared\Application\Bus\Query\QueryHandlerInterface;

final class GetProductsHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly RepositoryInterface $repository
    ) {}

    public function __invoke(GetProducts $query): array
    {
        $products = $this->repository->load($query->getPage(), $query->getLimit());

        dd($products);
    }
}
