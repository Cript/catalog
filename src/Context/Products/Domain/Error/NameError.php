<?php

namespace App\Context\Products\Domain\Error;

use App\Context\Shared\Domain\Error\DomainError;

class NameError extends DomainError
{
    public function __construct()
    {
        parent::__construct(sprintf('Name can\'t be empty'));
    }
}
