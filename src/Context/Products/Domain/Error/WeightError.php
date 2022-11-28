<?php

namespace App\Context\Products\Domain\Error;

use App\Context\Shared\Domain\Error\DomainError;

class WeightError extends DomainError
{
    public function __construct(string $weight)
    {
        parent::__construct(sprintf('Weight %s is invalid', $weight));
    }
}
