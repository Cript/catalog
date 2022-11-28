<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain\Error;

use Exception;

class DomainError extends Exception
{
    public static function create(): static
    {
        return new static();
    }
}
