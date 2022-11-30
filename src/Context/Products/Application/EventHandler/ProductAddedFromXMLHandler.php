<?php

namespace App\Context\Products\Application\EventHandler;

use App\Context\ImportXML\Domain\Event\ProductAddedFromXMLEvent;
use App\Context\Products\Application\Command\CreateOrUpdateProductFromXML\CreateOrUpdateProductFromXML;
use App\Context\Shared\Application\Bus\Event\EventHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class ProductAddedFromXMLHandler implements EventHandlerInterface
{
    public function __construct(
        private readonly MessageBusInterface $commandBus
    ) {}

    public function __invoke(ProductAddedFromXMLEvent $event)
    {
        $command = new CreateOrUpdateProductFromXML(
            $event->name(),
            $event->description(),
            $event->weight(),
            $event->category()
        );

        $this->commandBus->dispatch($command);
    }
}
