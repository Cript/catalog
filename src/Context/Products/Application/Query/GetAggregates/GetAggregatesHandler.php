<?php

namespace App\Context\Products\Application\Query\GetAggregates;

use App\Context\Products\Domain\ProductIndexRepositoryInterface;
use App\Context\Shared\Application\Bus\Query\QueryHandlerInterface;

final class GetAggregatesHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly ProductIndexRepositoryInterface $repository
    ) {}

    public function __invoke(GetAggregates $query): Response
    {
        $filters = $query->filter();
        $aggregates = [
            'default' => $this->repository->aggregates($filters->all())
        ];

        foreach ($filters->all() as $name => $value) {
            $aggregates[$name] = $this->repository->aggregates($filters->without($name));
        }

        return new Response($aggregates);
    }
}
