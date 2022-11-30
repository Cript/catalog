<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain;

use App\Context\Shared\Application\Bus\Event\EventInterface;
use Symfony\Component\Uid\Uuid;

abstract class DefaultEntity extends DefaultObjectInterface implements EntityInterface
{
    protected array $events = [];

    protected Uuid $id;

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

    public function id(): Uuid
    {
        return $this->id;
    }

    protected function record(EventInterface $event): void
    {
        $this->events[] = $event;
    }
}
