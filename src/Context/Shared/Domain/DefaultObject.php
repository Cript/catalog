<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain;

abstract class DefaultObject implements DomainObjectInterface
{
    final public function sameTypeAs(DomainObjectInterface $object): bool
    {
        return static::className() === $object::className();
    }

    final public function typeIs(string $className): bool
    {
        return static::class === $className;
    }

    final public function typeOf(string $className): bool
    {
        return $this instanceof $className;
    }

    final protected static function className(): string
    {
        return static::class;
    }
}
