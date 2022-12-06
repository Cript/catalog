<?php

namespace App\Tests\Context\Products\Domain\Event;

use App\Context\Products\Domain\Event\ProductCreatedEvent;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class ProductCreatedTest extends TestCase
{
    public function testConstructSuccess(): void
    {
        $id = Uuid::v4()->toRfc4122();
        $name = 'name';
        $description = 'description';
        $weight = 1000;
        $category = 'category';
        $categoryName = 'category_name';

        $event = new ProductCreatedEvent($id, $name, $description, $weight, $category, $categoryName);

        $this->assertInstanceOf(ProductCreatedEvent::class, $event);
        $this->assertEquals($id, $event->productId());
        $this->assertEquals($name, $event->name());
        $this->assertEquals($description, $event->description());
        $this->assertEquals($weight, $event->weight());
        $this->assertEquals($category, $event->categoryId());
    }
}
