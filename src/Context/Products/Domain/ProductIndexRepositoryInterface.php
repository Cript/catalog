<?php

namespace App\Context\Products\Domain;

interface ProductIndexRepositoryInterface
{
    public function load(array $filter, int $page, int $perPage, string $sortBy, string $sortOrder): array;
    public function aggregates(array $filter): array;
    public function create(string $id, string $name, string $description, int $weight, string $categoryId, string $categoryName): void;
    public function update(string $id, string $name, string $description, int $weight, string $categoryId, string $categoryName): void;
}
