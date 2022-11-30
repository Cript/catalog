<?php

namespace App\Context\ImportXML\Application\Command\ImportXML;

use App\Context\ImportXML\Application\Command\ImportXML\Error\FileNotExistsError;
use App\Context\ImportXML\Domain\Import;
use App\Context\ImportXML\Domain\ImportRepositoryInterface;
use App\Context\ImportXML\Domain\Product;
use App\Context\ImportXML\Domain\ProductRepositoryInterface;
use App\Context\Shared\Application\Bus\Command\CommandHandlerInterface;
use Symfony\Component\Filesystem\Filesystem;

final class ImportXMLHandler implements CommandHandlerInterface
{
    public function __construct(
        private Filesystem $filesystem,
        private readonly ImportRepositoryInterface $importRepository,
        private readonly ProductRepositoryInterface $productRepository
    ) {}

    public function __invoke(ImportXML $command): void
    {
        if(!$this->filesystem->exists($command->fileName())) {
            throw new FileNotExistsError($command->fileName());
        }

        $xmlReader = new \XMLReader();
        $xmlReader->open($command->fileName());

        $import = Import::create($command->fileName());

        $this->importRepository->save($import);

        while ($xmlReader->read() && $xmlReader->name !== 'product') {};

        while ($xmlReader->name === 'product')
        {
            $node = new \SimpleXMLElement($xmlReader->readOuterXML());

            $product = Product::create(
                $node->name,
                $node->description,
                $node->weight,
                $node->category,
                $import
            );

            $this->productRepository->save($product);

            $xmlReader->next('product');
        }
    }
}
