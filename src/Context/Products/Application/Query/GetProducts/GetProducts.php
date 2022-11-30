<?php

namespace App\Context\Products\Application\Query\GetProducts;

use App\Context\Shared\Application\Bus\Query\QueryInterface;

class GetProducts implements QueryInterface
{
    public function __construct(
        private readonly ?int $page = null,
        private readonly ?int $limit = null,
        private readonly ?string $categoryId = null
    ) {}

    public function page(): ?int
    {
        return $this->page;
    }

    public function limit(): ?int
    {
        return $this->limit;
    }

    public function categoryId(): ?string
    {
        return $this->categoryId;
    }
}
