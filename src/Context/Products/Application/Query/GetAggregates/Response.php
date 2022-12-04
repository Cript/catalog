<?php

namespace App\Context\Products\Application\Query\GetAggregates;

class Response
{
    public function __construct(
        private readonly array $aggregates
    ) {}

    public function aggregates(): array
    {
        return $this->aggregates;
    }
}
