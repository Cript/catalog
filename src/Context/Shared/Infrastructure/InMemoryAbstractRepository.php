<?php

declare(strict_types=1);

namespace App\Context\Shared\Infrastructure;

use App\Context\Shared\Domain\DefaultEntity;

abstract class InMemoryAbstractRepository implements \Countable
{
    protected array $items = [];

    /**
     * @param DefaultEntity $object
     * @return void
     */
    protected function add($object): void
    {
        $this->items[$object->id()->toRfc4122()] = $object;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function all(): array
    {
        return $this->items;
    }

    public function first()
    {
        return array_shift($this->items);
    }
}
