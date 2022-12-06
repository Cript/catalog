<?php

namespace App\Context\Products\Application\Query\GetProducts;

use App\Context\Products\Application\Query\Filter;
use App\Context\Products\Application\Query\Sorting;
use App\Context\Shared\Application\Bus\Query\QueryInterface;

class GetProducts implements QueryInterface
{
    private int $perPage = 10;

    public function __construct(
        private readonly Filter $filter,
        private readonly int $page,
        private readonly Sorting $sorting
    ) {}

    public function filter(): Filter
    {
        return $this->filter;
    }

    public function page(): int
    {
        return $this->page;
    }

    public function perPage(): int
    {
        return $this->perPage;
    }

    public function sorting(): Sorting
    {
        return $this->sorting;
    }
}
