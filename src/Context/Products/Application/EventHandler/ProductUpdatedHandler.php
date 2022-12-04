<?php

namespace App\Context\Products\Application\EventHandler;

use App\Context\Products\Domain\Event\ProductUpdatedEvent;
use App\Context\Products\Domain\ProductIndexRepositoryInterface;
use App\Context\Shared\Application\Bus\Event\EventHandlerInterface;

final class ProductUpdatedHandler implements EventHandlerInterface
{
    public function __construct(
        private readonly ProductIndexRepositoryInterface $repository
    ) {}

    public function __invoke(ProductUpdatedEvent $event)
    {
        $this->repository->update(
            $event->productId(),
            $event->name(),
            $event->description(),
            $event->weight(),
            $event->categoryId(),
            $event->categoryName()
        );
    }
}
