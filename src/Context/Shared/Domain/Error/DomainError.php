<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain\Error;

use Exception;
use Throwable;

class DomainError extends Exception
{
    public static function create()
    {
        return new static();
    }

    public static function withMessage(string $message)
    {
        return new static($message);
    }

    public static function fromPrevious(string $message, Throwable $previous = null)
    {
        return new static($message, 0, $previous);
    }
}
