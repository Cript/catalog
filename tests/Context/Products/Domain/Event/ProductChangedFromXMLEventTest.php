<?php

namespace App\Tests\Context\Products\Domain\Event;

use App\Context\Products\Domain\Event\ProductChangedFromXMLEvent;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class ProductChangedFromXMLEventTest extends TestCase
{
    public function testConstructSuccess(): void
    {
        $id = Uuid::v4()->toRfc4122();

        $event = new ProductChangedFromXMLEvent($id);

        $this->assertInstanceOf(ProductChangedFromXMLEvent::class, $event);
        $this->assertEquals($id, $event->productImportId());
    }
}
