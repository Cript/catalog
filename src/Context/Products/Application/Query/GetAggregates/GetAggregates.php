<?php

namespace App\Context\Products\Application\Query\GetAggregates;

use App\Context\Products\Application\Query\Filter;
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
