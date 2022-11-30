<?php

namespace App\Context\Products\Domain\ValueObject;

use App\Context\Products\Domain\Error\NameError;
use App\Context\Shared\Domain\SimpleValueObject;

class Name extends SimpleValueObject
{
    public static function fromString(string $name): static {
        if (empty(trim($name))) {
            throw new NameError();
        }

        return new static($name);
    }
}
