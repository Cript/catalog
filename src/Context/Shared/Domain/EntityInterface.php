<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain;

use Symfony\Component\Uid\Uuid;

interface EntityInterface extends DomainObjectInterface
{
    public function id(): Uuid;
}
