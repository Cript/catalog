<?php

namespace App\Tests\Context\Products\Application\EventHandler;

use App\Context\Products\Application\EventHandler\ProductUpdatedHandler;
use App\Context\Products\Domain\Event\ProductUpdatedEvent;
use App\Context\Products\Infrastructure\ProductIndexInMemoryRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductUpdatedHandlerTest extends KernelTestCase
{
    private ProductUpdatedHandler $handler;
    private ProductIndexInMemoryRepository $productIndexRepository;

    public function setUp(): void
    {
        static::bootKernel();

        $this->productIndexRepository = $this->createMock(ProductIndexInMemoryRepository::class);
        $this->handler = new ProductUpdatedHandler($this->productIndexRepository);
    }

    public function testRepositoryCreateCall()
    {
        $id = 'id';
        $name = 'name';
        $description = 'description';
        $weight = 10000;
        $categoryId = 'category_id';
        $categoryName = 'category_name';

        $this->productIndexRepository
            ->expects($this->once())
            ->method('update')
            ->with($id, $name, $description, $weight, $categoryId, $categoryName);

        $event = new ProductUpdatedEvent($id, $name, $description, $weight, $categoryId, $categoryName);
        call_user_func($this->handler, $event);
    }
}
