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
        private readonly int $weight,
        private readonly string $categoryId,
        private readonly string $categoryName,
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

    public function weight(): int
    {
        return $this->weight;
    }

    public function categoryId(): string
    {
        return $this->categoryId;
    }

    public function categoryName(): string
    {
        return $this->categoryName;
    }
}
