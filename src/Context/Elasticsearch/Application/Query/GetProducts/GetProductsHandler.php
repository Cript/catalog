<?php

namespace App\Context\Elasticsearch\Application\Query\GetProducts;

use App\Context\Elasticsearch\Domain\RepositoryInterface;
use App\Context\Shared\Application\Bus\Query\QueryHandlerInterface;

final class GetProductsHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly RepositoryInterface $repository
    ) {}

    public function __invoke(GetProducts $query): Response
    {
        return $this->repository->products(
            $query->filter()->all(),
            $query->page(),
            $query->perPage()
        );
    }
}
