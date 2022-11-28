<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain;

abstract class DefaultEntity extends DefaultObjectInterface implements EntityInterface
{
    protected array $events = [];

    protected IdInterface $id;

    public function equals(DomainObjectInterface $object): bool
    {
        return $this->sameTypeAs($object) && $this->id()->equals($object->id());
    }

    public function popEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    public function id(): IdInterface
    {
        return $this->id;
    }

    protected function record(Event $event): void
    {
        $this->events[] = $event;
    }
}
