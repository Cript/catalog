<?php

namespace App\Context\Elasticsearch\Application\Query\GetAggregates;

use App\Context\Elasticsearch\Domain\Filter;
use App\Context\Shared\Application\Bus\Query\QueryInterface;

class GetAggregates implements QueryInterface
{
    public function __construct(
        private readonly Filter $filter
    ) {}

    public function filter(): Filter
    {
        return $this->filter;
    }
}
