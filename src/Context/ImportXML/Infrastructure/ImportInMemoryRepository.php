<?php

namespace App\Context\ImportXML\Infrastructure;

use App\Context\ImportXML\Domain\Import;
use App\Context\ImportXML\Domain\ImportRepositoryInterface;
use App\Context\Shared\Infrastructure\InMemoryAbstractRepository;

class ImportInMemoryRepository extends InMemoryAbstractRepository implements ImportRepositoryInterface
{
    public function save(Import $import)
    {
        $this->add($import);
    }
}
