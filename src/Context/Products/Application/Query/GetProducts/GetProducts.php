<?php

namespace App\Context\Products\Application\Query\GetProducts;

use App\Context\Shared\Application\Bus\Query\QueryInterface;

class GetProducts implements QueryInterface
{
    public function __construct(
        private int $page,
        private int $limit
    ) {}

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}
