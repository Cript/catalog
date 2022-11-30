<?php

namespace App\Tests\Context\ImportXML\Application\Command\ImportXML;

use App\Context\ImportXML\Application\Command\ImportXML\ImportXML;
use PHPUnit\Framework\TestCase;

class ImportXMLTest extends TestCase
{
    public function testConstructSuccess(): void
    {
        $fileName = 'file_name';
        $importXML = new ImportXML($fileName);

        $this->assertInstanceOf(ImportXML::class, $importXML);
        $this->assertEquals($fileName, $importXML->fileName());
    }
}
