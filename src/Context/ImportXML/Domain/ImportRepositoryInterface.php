<?php

namespace App\Context\ImportXML\Domain;

interface ImportRepositoryInterface
{
    public function save(Import $import);
}
