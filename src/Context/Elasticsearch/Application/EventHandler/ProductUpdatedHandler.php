<?php

namespace App\Context\Elasticsearch\Application\EventHandler;

use App\Context\Elasticsearch\Domain\RepositoryInterface;
use App\Context\Products\Domain\Event\ProductUpdatedEvent;
use App\Context\Shared\Application\Bus\Event\EventHandlerInterface;

final class ProductUpdatedHandler implements EventHandlerInterface
{
    public function __construct(
        private RepositoryInterface $repository
    ) {}

    public function __invoke(ProductUpdatedEvent $event)
    {
        $this->repository->update(
            $event->productId(),
            $event->name(),
            $event->description(),
            $event->weight(),
            $event->categoryId()
        );
    }
}
