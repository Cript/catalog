<?php

namespace App\Context\Products\Application\Query\GetProducts;

class Response
{
    public function __construct(
        private readonly int $total,
        private readonly array $products
    ) {}

    public function total(): int
    {
        return $this->total;
    }

    public function products(): array
    {
        return $this->products;
    }
}
