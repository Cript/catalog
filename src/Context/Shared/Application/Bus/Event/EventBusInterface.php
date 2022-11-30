<?php

declare(strict_types=1);

namespace App\Context\Shared\Application\Bus\Event;

interface EventBusInterface
{
    public function dispatch(EventInterface $query);
}
