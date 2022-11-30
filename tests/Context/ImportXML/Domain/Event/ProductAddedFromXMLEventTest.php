<?php

namespace App\Tests\Context\ImportXML\Domain\Event;

use App\Context\ImportXML\Domain\Event\ProductAddedFromXMLEvent;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class ProductAddedFromXMLEventTest extends TestCase
{
    public function testConstructSuccess(): void
    {
        $id = Uuid::v4()->toRfc4122();
        $name = 'name';
        $description = 'description';
        $weight = '10 g';
        $category = 'category';

        $event = new ProductAddedFromXMLEvent($id, $name, $description, $weight, $category);

        $this->assertInstanceOf(ProductAddedFromXMLEvent::class, $event);
        $this->assertEquals($id, $event->productId());
        $this->assertEquals($name, $event->name());
        $this->assertEquals($description, $event->description());
        $this->assertEquals($weight, $event->weight());
        $this->assertEquals($category, $event->category());
    }
}
