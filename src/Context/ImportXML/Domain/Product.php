<?php

namespace App\Context\ImportXML\Domain;

use App\Context\ImportXML\Domain\Event\ProductAddedFromXMLEvent;
use App\Context\Shared\Domain\AggregateRoot;
use Symfony\Component\Uid\Uuid;

class Product extends AggregateRoot
{
    private const STATUS_ADDED = 1;
    private const STATUS_COMPLETED = 5;
    private const STATUS_FAILED = 10;

    private int $status;

    private function __construct(
        Uuid $id,
        private readonly string $name,
        private readonly string $description,
        private readonly string $weight,
        private readonly string $category,
        private Import $import
    ) {
        $this->id = $id;
        $this->status = Product::STATUS_ADDED;

        $this->record(new ProductAddedFromXMLEvent(
            $this->id()->toRfc4122(),
            $this->name,
            $this->description,
            $this->weight,
            $this->category
        ));
    }

    public static function create(
        string $name,
        string $description,
        string $weight,
        string $category,
        Import $import
    ): Product
    {
        $product = new Product(
            Uuid::v4(),
            $name,
            $description,
            $weight,
            $category,
            $import
        );

        return $product;
    }
}
