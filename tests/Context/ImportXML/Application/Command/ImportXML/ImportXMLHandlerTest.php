<?php

namespace App\Tests\Context\ImportXML\Application\Command\ImportXML;

use App\Context\ImportXML\Application\Command\ImportXML\Error\FileNotExistsError;
use App\Context\ImportXML\Application\Command\ImportXML\ImportXML;
use App\Context\ImportXML\Application\Command\ImportXML\ImportXMLHandler;
use App\Context\ImportXML\Domain\Product;
use App\Context\Shared\Infrastructure\InMemoryAbstractRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ImportXMLHandlerTest extends WebTestCase
{
    private ImportXMLHandler $handler;
    private InMemoryAbstractRepository $importRepository;
    private InMemoryAbstractRepository $productRepository;

    public function setUp(): void
    {
        static::bootKernel();

        $this->handler = $this->getContainer()->get('test.import_xml.handler');
        $this->importRepository = $this->getContainer()->get('test.import_xml.import_repository');
        $this->productRepository = $this->getContainer()->get('test.import_xml.product_repository');
    }

    public function testImportCreated(): void
    {
        $command = new ImportXML(realpath(__DIR__.'/import.xml'));
        call_user_func($this->handler, $command);

        $this->assertCount(1, $this->importRepository);
        $this->assertCount(10, $this->productRepository);
    }

    public function testEventsAdded(): void
    {
        $command = new ImportXML(realpath(__DIR__.'/import.xml'));
        call_user_func($this->handler, $command);

        $products = $this->productRepository->all();

        /**
         * @var Product $product
         */
        foreach ($products as $product) {
            $this->assertCount(1, $product->popEvents());
        }
    }

    public function testThrowErrorIfFileNotExists(): void
    {
        $this->expectException(FileNotExistsError::class);

        $command = new ImportXML('file_name');
        call_user_func($this->handler, $command);
    }
}
