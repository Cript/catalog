<?php

declare(strict_types=1);

namespace App\Context\Products\Domain\Event;

use App\Context\Shared\Application\Bus\Event\EventInterface;

class ProductCreatedEvent implements EventInterface
{
    public function __construct(
        private readonly string $productId,
        private readonly string $name,
        private readonly string $description,
        private readonly string $weight,
        private readonly string $categoryId,
    ) {}

    public function productId(): string
    {
        return $this->productId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function weight(): string
    {
        return $this->weight;
    }

    public function categoryId(): string
    {
        return $this->categoryId;
    }
}
