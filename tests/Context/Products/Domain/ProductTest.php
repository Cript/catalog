<?php

declare(strict_types=1);

namespace App\Tests\Context\Products\Domain\ValueObject;

use App\Context\Products\Domain\Category;
use App\Context\Products\Domain\Product;
use App\Context\Products\Domain\ValueObject\Name;
use App\Context\Products\Domain\ValueObject\Weight;
use PHPUnit\Framework\TestCase;

final class ProductTest extends TestCase
{
    public function testConstructSuccess(): void
    {
        $productName = Name::fromString('product_name');
        $categoryName = Name::fromString('category_name');
        $category = Category::create($categoryName);
        $weight = Weight::fromGram(200);

        $product = Product::create(
            $productName,
            'description',
            $weight,
            $category
        );


        $this->assertInstanceOf(Product::class, $product);
    }
}
