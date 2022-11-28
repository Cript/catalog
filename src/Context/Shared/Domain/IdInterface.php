<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain;

interface IdInterface extends ValueObjectInterface
{
    public function value();
}
