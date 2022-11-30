<?php

namespace App\Context\ImportXML\Application\Command\ImportXML\Error;

use App\Context\Shared\Application\UseCaseError;

class FileNotExistsError extends UseCaseError
{
    public function __construct(string $fileName)
    {
        parent::__construct(sprintf('Import file "%s" not exists', $fileName));
    }
}
