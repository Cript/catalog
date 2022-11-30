<?php

namespace App\Tests\Context\ImportXML\Domain;

use App\Context\ImportXML\Domain\Import;
use PHPUnit\Framework\TestCase;

class ImportTest extends TestCase
{
    public function testConstructSuccess(): void
    {
        $fileName = 'file_name';
        $import = Import::create($fileName);

        $this->assertInstanceOf(Import::class, $import);
    }
}
