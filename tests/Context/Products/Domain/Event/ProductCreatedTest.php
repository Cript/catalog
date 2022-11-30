<?php

namespace App\Tests\Context\ImportXML\Domain\Event;

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
        $weight = '10 g';
        $category = 'category';

        $event = new ProductCreatedEvent($id, $name, $description, $weight, $category);

        $this->assertInstanceOf(ProductCreatedEvent::class, $event);
        $this->assertEquals($id, $event->productId());
        $this->assertEquals($name, $event->name());
        $this->assertEquals($description, $event->description());
        $this->assertEquals($weight, $event->weight());
        $this->assertEquals($category, $event->categoryId());
    }
}
