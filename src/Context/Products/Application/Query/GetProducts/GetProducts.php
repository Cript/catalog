<?php

namespace App\Context\Products\Application\Query\GetProducts;

use App\Context\Elasticsearch\Domain\Filter;
use App\Context\Shared\Application\Bus\Query\QueryInterface;

class GetProducts implements QueryInterface
{
    public function __construct(
        private readonly Filter $filter,
        private readonly int $page,
        private readonly string $sort
    ) {}

    public function filter(): Filter
    {
        return $this->filter;
    }

    public function page(): int
    {
        return $this->page;
    }
}
