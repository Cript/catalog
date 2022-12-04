<?php

declare(strict_types=1);

namespace App\Context\Products\Domain\Event;

use App\Context\Shared\Application\Bus\Event\EventInterface;

class ProductCreatedFromXMLEvent implements EventInterface
{
    public function __construct(
        private readonly string $productImportId
    ) {}

    public function productImportId(): string
    {
        return $this->productImportId;
    }
}
