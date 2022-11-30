<?php

namespace App\Context\ImportXML\Infrastructure;

use App\Context\ImportXML\Domain\Product;
use App\Context\ImportXML\Domain\ProductRepositoryInterface;
use App\Context\Shared\Infrastructure\InMemoryAbstractRepository;

class ProductInMemoryRepository extends InMemoryAbstractRepository implements ProductRepositoryInterface
{
    public function save(Product $product)
    {
        $this->add($product);
    }
}
