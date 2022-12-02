<?php

namespace App\Context\Products\Domain;

use App\Context\Products\Domain\Event\ProductCreatedEvent;
use App\Context\Products\Domain\Event\ProductChangedFromXMLEvent;
use App\Context\Products\Domain\Event\ProductUpdatedEvent;
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

        $this->record(new ProductCreatedEvent(
            $this->id()->toRfc4122(),
            $this->name->value(),
            $this->description,
            $this->weight->asInteger(),
            $this->category->id()
        ));
    }

    public static function create(
        Name $name,
        string $description,
        Weight $weight,
        Category $category
    ): Product
    {
        $product = new Product(
            Uuid::v4(),
            $name,
            $description,
            $weight,
            $category
        );

        return $product;
    }

    public static function createFromXML(
        Name $name,
        string $description,
        Weight $weight,
        Category $category
    ): Product
    {
        $product = Product::create($name, $description, $weight, $category);

        $product->record(new ProductChangedFromXMLEvent(
            $product->id()->toRfc4122()
        ));

        return $product;
    }

    public function updateFromXML(
        Name $name,
        string $description,
        Weight $weight,
        Category $category
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->weight = $weight;
        $this->category = $category;

        $this->record(new ProductUpdatedEvent(
            $this->id()->toRfc4122(),
            $this->name->value(),
            $this->description,
            $this->weight->asInteger(),
            $this->category->id()
        ));
        $this->record(new ProductChangedFromXMLEvent($this->id()->toRfc4122()));
    }
}
