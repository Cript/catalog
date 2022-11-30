<?php

namespace App\Context\ImportXML\Domain;

interface ProductRepositoryInterface
{
    public function save(Product $product);
}
