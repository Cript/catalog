<?php

namespace App\Context\Products\Domain;

use App\Context\Products\Domain\ValueObject\Name;
use App\Context\Products\Domain\ValueObject\Weight;
use App\Context\Shared\Domain\AggregateRoot;
use Symfony\Component\Uid\Uuid;

final class Product extends AggregateRoot
{
    private function __construct(
        Uuid $id,
        private Name $name,
        private string $description,
        private Weight $weight,
        private Category $category
    ) {
        $this->id = $id;
    }

    public static function create(
        Name $name,
        string $description,
        Weight $weight,
        Category $category
    ): static {
        $product = new Product(
            Uuid::v4(),
            $name,
            $description,
            $weight,
            $category
        );

        return $product;
    }
}
