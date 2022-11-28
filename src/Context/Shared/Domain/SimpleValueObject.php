<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain;

abstract class SimpleValueObject extends DefaultValueObject
{
    protected $value;

    protected function __construct($value)
    {
        $this->value = $value;
    }

    public static function create($value)
    {
        return new static($value);
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(DomainObjectInterface $object): bool
    {
        return $object->sameTypeAs($object) && $object->value() === $this->value();
    }
}
