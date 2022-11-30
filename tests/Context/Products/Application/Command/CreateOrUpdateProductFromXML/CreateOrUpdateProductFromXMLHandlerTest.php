<?php

declare(strict_types=1);

namespace App\Tests\Context\Products\Application\Command\CreateOrUpdateProductFromXML;

use App\Context\Products\Application\Command\CreateOrUpdateProductFromXML\CreateOrUpdateProductFromXML;
use App\Context\Products\Application\Command\CreateOrUpdateProductFromXML\CreateOrUpdateProductFromXMLHandler;
use App\Context\Shared\Infrastructure\InMemoryAbstractRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class CreateOrUpdateProductFromXMLHandlerTest extends KernelTestCase
{
    private CreateOrUpdateProductFromXMLHandler $handler;
    private InMemoryAbstractRepository $productRepository;
    private InMemoryAbstractRepository $categoryRepository;

    public function setUp(): void
    {
        $this->bootKernel();
        $this->handler = static::$kernel->getContainer()->get('test.product.create_or_update_product_from_xml');
        $this->productRepository = static::$kernel->getContainer()->get('test.product.product_repository');
        $this->categoryRepository = static::$kernel->getContainer()->get('test.product.category_repository');
    }

    public function testNewProductCreated()
    {
        $command = new CreateOrUpdateProductFromXML(
            'product_name',
            'product_description',
            '100 g',
            'category_name'
        );
        call_user_func($this->handler, $command);

        $this->assertCount(1, $this->productRepository);
        $this->assertCount(1, $this->categoryRepository);
    }

    public function testNewProductsAndCategoriesNotAdded()
    {
        $command = new CreateOrUpdateProductFromXML(
            'product_name',
            'product_description',
            '100 g',
            'category_name'
        );
        call_user_func($this->handler, $command);

        $command = new CreateOrUpdateProductFromXML(
            'product_name',
            'product_description',
            '10 kg',
            'category_name'
        );
        call_user_func($this->handler, $command);

        $this->assertCount(1, $this->productRepository);
        $this->assertCount(1, $this->categoryRepository);
    }
}
