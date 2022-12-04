<?php

namespace App\Context\Products\Application\Query\GetProducts;

use App\Context\Products\Domain\ProductIndexRepositoryInterface;
use App\Context\Shared\Application\Bus\Query\QueryHandlerInterface;

final class GetProductsHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly ProductIndexRepositoryInterface $repository
    ) {}

    public function __invoke(GetProducts $query): Response
    {
        $result = $this->repository->load(
            $query->filter()->all(),
            $query->page(),
            $query->perPage(),
            $query->sorting()->sortBy(),
            $query->sorting()->sortOrder()
        );

        return new Response($result['total'], $result['products']);
    }
}
