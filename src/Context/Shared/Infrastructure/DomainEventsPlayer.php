<?php

namespace App\Context\Shared\Infrastructure;

use App\Context\Shared\Application\Bus\Event\EventBusInterface;
use App\Context\Shared\Application\Bus\Event\EventInterface;
use App\Context\Shared\Domain\DefaultEntity;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Messenger\MessageBusInterface;


final class DomainEventsPlayer implements EventSubscriberInterface
{
    private array $entities = [];

    private MessageBusInterface $eventBus;

    public function __construct(MessageBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    /**
     * @inheritDoc
     */
    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
            Events::postUpdate,
            Events::postRemove,
            Events::postFlush
        ];
    }

    public function postPersist($event): void
    {
        $this->keepEntities($event);
    }

    public function postUpdate($event): void
    {
        $this->keepEntities($event);
    }

    public function postRemove($event): void
    {
        $this->keepEntities($event);
    }

    public function postFlush(PostFlushEventArgs $doctrineEvent): void
    {
        foreach ($this->entities as $entity) {
            /**
             * @var DefaultEntity $entity
             */
            foreach ($entity->popEvents() as $event) {
                /**
                 * @var EventInterface $event
                 */
                $this->eventBus->dispatch($event);
            }
        }

        $this->entities = [];
    }

    private function keepEntities(LifecycleEventArgs $event): void
    {
        $entity = $event->getObject();

        if (!($entity instanceof DefaultEntity)) {
            return;
        }

        $this->entities[] = $entity;
    }
}
