<?php

namespace App\Tests\Context\ImportXML\Domain;

use App\Context\ImportXML\Domain\Import;
use App\Context\ImportXML\Domain\Product;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class ProductTest extends TestCase
{
    public function testConstructSuccess(): void
    {
        $name = 'name';
        $description = 'description';
        $weight = '10 g';
        $category = 'category';

        $fileName = 'file_name';
        $import = Import::create($fileName);

        $product = Product::create($name, $description, $weight, $category, $import);

        $this->assertInstanceOf(Product::class, $product);
    }
}
