<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain;

interface DomainObjectInterface
{
    public function sameTypeAs(DomainObjectInterface $object): bool;

    public function typeOf(string $className): bool;

    public function typeIs(string $className): bool;

//    public function equals(DomainObjectInterface $object): bool;
}
