<?php

namespace App\Context\Elasticsearch\Application\EventHandler;

use App\Context\Elasticsearch\Domain\RepositoryInterface;
use App\Context\Products\Domain\Event\ProductCreatedEvent;
use App\Context\Shared\Application\Bus\Event\EventHandlerInterface;

final class ProductCreatedHandler implements EventHandlerInterface
{
    public function __construct(
        private RepositoryInterface $repository
    ) {}

    public function __invoke(ProductCreatedEvent $event)
    {
        $this->repository->create(
            $event->productId(),
            $event->name(),
            $event->description(),
            $event->weight(),
            $event->categoryId()
        );
    }
}
