<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain;

interface EntityInterface extends DomainObjectInterface
{
    public function id(): IdInterface;
}
