<?php

declare(strict_types=1);

namespace App\Context\Shared\Application\Bus\Command;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}
