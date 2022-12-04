<?php

namespace App\Context\Products\Infrastructure;

use App\Context\Products\Domain\Product;
use App\Context\Products\Domain\ProductRepositoryInterface;
use App\Context\Shared\Infrastructure\InMemoryAbstractRepository;

class ProductInMemoryRepository extends InMemoryAbstractRepository implements ProductRepositoryInterface
{
    public function load(?array $filter, int $page, int $perPage, string $sortBy, string $sortOrder): array
    {
        return [];
    }

    public function loadByName(string $name): ?Product
    {
        $products = array_filter($this->items, function (Product $product) use ($name) {
            $productName = (new \ReflectionObject($product))->getProperty('name')->getValue($product);

            if ($productName->value() === $name) {
                return true;
            }

            return false;
        });

        if (empty($products)) {
            return null;
        }

        return array_shift($products);
    }

    public function create(Product $product): void
    {
        $this->add($product);
    }

    public function update(Product $product): void
    {
        $this->add($product);
    }
}
