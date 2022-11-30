<?php

namespace App\Context\ImportXML\Domain;

use App\Context\Shared\Domain\AggregateRoot;
use Symfony\Component\Uid\Uuid;

class Import extends AggregateRoot
{
    private \DateTime $addedAt;

    private function __construct(
        Uuid $id,
        private string $fileName
    )
    {
        $this->id = $id;
        $this->addedAt = new \DateTime();
    }

    public static function create(
        string $fileName
    ): static {
        return new static(Uuid::v4(), $fileName);
    }
}


