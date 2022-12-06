<?php

declare(strict_types=1);

namespace App\Tests\Context\Products\Application\Query\GetCategories;

use App\Context\Products\Application\Query\GetCategories\GetCategories;
use App\Context\Products\Application\Query\GetCategories\GetCategoriesHandler;
use App\Context\Products\Domain\Category;
use App\Context\Products\Domain\ValueObject\Name;
use App\Context\Products\Infrastructure\CategoryInMemoryRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GetCategoriesHandlerTest extends KernelTestCase
{
    private GetCategoriesHandler $handler;
    private CategoryInMemoryRepository $repository;

    public function setUp(): void
    {
        static::bootKernel();

        $this->repository = static::$kernel->getContainer()->get('test.product.category_repository');
        $this->handler = static::$kernel->getContainer()->get('test.product.get_categories');
    }

    public function testSave(): void
    {
        $name = Name::create('name');
        $category = Category::create($name);
        $this->repository->save($category);

        $query = new GetCategories();
        $result = call_user_func($this->handler, $query);

        $this->assertCount(1, $result);
        $this->assertNotEmpty($result[0]['id']);
        $this->assertEquals($name->value(), $result[0]['name']);
    }
}
