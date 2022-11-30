<?php

namespace App\Context\Products\Domain;

interface ProductRepositoryInterface
{
    public function load(int $page, int $limit, string $category): array;
    public function getByName(string $name): ?Product;
    public function save(Product $product): void;
}
