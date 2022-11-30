<?php

namespace App\Context\ImportXML\Application\Command\ImportXML;

use App\Context\Shared\Application\Bus\Command\CommandInterface;

final class ImportXML implements CommandInterface
{
    public function __construct(
        private readonly string $fileName
    ) {}

    public function fileName(): string
    {
        return $this->fileName;
    }
}
