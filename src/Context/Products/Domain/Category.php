<?php

namespace App\Context\Products\Domain;

use App\Context\Products\Domain\ValueObject\Name;
use App\Context\Shared\Domain\AggregateRoot;
use Symfony\Component\Uid\Uuid;

class Category extends AggregateRoot
{
    private function __construct(
        Uuid $id,
        private Name $name
    )
    {
        $this->id = $id;
    }

    public static function create(
        Name $name
    ): Category {
        return new static(Uuid::v4(), $name);
    }

    public function name(): Name
    {
        return $this->name;
    }
}


