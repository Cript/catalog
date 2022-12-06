<?php

namespace App\Context\Products\Infrastructure;

use App\Context\Products\Domain\ProductIndexRepositoryInterface;
use App\Context\Shared\Infrastructure\InMemoryAbstractRepository;

class ProductIndexInMemoryRepository extends InMemoryAbstractRepository implements ProductIndexRepositoryInterface
{
    public function load(array $filter, int $page, int $perPage, ?string $sortBy, ?string $sortOrder): array
    {
        return [];
    }

    public function create(string $id, string $name, string $description, int $weight, string $categoryId, string $categoryName): void
    {

    }

    public function update(string $id, string $name, string $description, int $weight, string $categoryId, string $categoryName): void
    {

    }

    public function aggregates(array $filter): array {
        return [];
    }
}
