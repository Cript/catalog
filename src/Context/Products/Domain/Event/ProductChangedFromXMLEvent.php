<?php

declare(strict_types=1);

namespace App\Context\Products\Domain\Event;

use App\Context\Shared\Application\Bus\Event\EventInterface;

class ProductChangedFromXMLEvent implements EventInterface
{
    public function __construct(
        private readonly string $productId
    ) {}

    public function productId(): string
    {
        return $this->productId;
    }
}
