<?php

namespace App\Context\Products\Domain;

interface ProductRepositoryInterface
{
    public function loadByName(string $name): ?Product;
    public function create(Product $product): void;
    public function update(Product $product): void;
}
