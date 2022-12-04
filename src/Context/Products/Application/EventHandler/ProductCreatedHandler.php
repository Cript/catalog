<?php

namespace App\Context\Products\Application\EventHandler;

use App\Context\Products\Domain\Event\ProductCreatedEvent;
use App\Context\Products\Domain\ProductIndexRepositoryInterface;
use App\Context\Shared\Application\Bus\Event\EventHandlerInterface;

final class ProductCreatedHandler implements EventHandlerInterface
{
    public function __construct(
        private readonly ProductIndexRepositoryInterface $repository
    ) {}

    public function __invoke(ProductCreatedEvent $event)
    {
        $this->repository->create(
            $event->productId(),
            $event->name(),
            $event->description(),
            $event->weight(),
            $event->categoryId(),
            $event->categoryName()
        );
    }
}
