<?php

namespace App\Tests\Context\Products\Domain\Event;

use App\Context\Products\Domain\Event\ProductChangedFromXMLEvent;
use App\Context\Products\Domain\Event\ProductCreatedFromXMLEvent;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class ProductCreatedFromXMLEventTest extends TestCase
{
    public function testConstructSuccess(): void
    {
        $id = Uuid::v4()->toRfc4122();

        $event = new ProductCreatedFromXMLEvent($id);

        $this->assertInstanceOf(ProductCreatedFromXMLEvent::class, $event);
        $this->assertEquals($id, $event->productImportId());
    }
}
