<?php

declare(strict_types=1);

namespace App\Context\Shared\Infrastructure\Bus;

use App\Context\Shared\Application\Bus\Command\CommandInterface;
use App\Context\Shared\Application\Bus\Command\CommandBusInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;

class CommandBus implements CommandBusInterface
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function dispatch(CommandInterface $command): void
    {
        try {
            $this->messageBus->dispatch($command);
        } catch (HandlerFailedException $e) {
            throw $e->getNestedExceptions()[0];
        }

    }
}
