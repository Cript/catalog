<?php

declare(strict_types=1);

namespace App\Context\Shared\Infrastructure\Bus;

use App\Context\Shared\Application\Bus\Query\QueryBusInterface;
use App\Context\Shared\Application\Bus\Query\QueryInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class QueryBus implements QueryBusInterface
{
    use HandleTrait;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }

    public function ask(QueryInterface $query)
    {
        try {
            return $this->handle($query);
        } catch (HandlerFailedException $e) {
            throw $e->getNestedExceptions()[0];
        }
    }
}
