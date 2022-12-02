<?php

declare(strict_types=1);

namespace App\Tests\Context\Elasticsearch\Domain;

use App\Context\Elasticsearch\Domain\Filter;
use PHPUnit\Framework\TestCase;

final class FilterTest extends TestCase
{
    public function testExistsEmpty(): void
    {
        $filter = new Filter([]);
        $this->assertFalse($filter->exists('name'));
        $this->assertFalse($filter->exists('categories'));
        $this->assertFalse($filter->exists('weight_min'));
        $this->assertFalse($filter->exists('weight_max'));
    }

    public function testExistsEmptyName(): void
    {
        $filter = new Filter([
            'name' => ''
        ]);
        $this->assertFalse($filter->exists('name'));
    }

    public function testWithoutName(): void
    {
        $filter = new Filter([
            'name' => 'product_name',
            'categories' => []
        ]);
        $this->assertEmpty($filter->without('name'));
    }

    public function testWithoutWeight(): void
    {
        $filter = new Filter([
            "weight_min" => "1",
            "weight_max" => "100"
        ]);
        $this->assertEquals([
            "weight_max" => "100"
        ],
        $filter->without('weight_min'));
    }

    public function testAll(): void
    {
        $filter = new Filter([
            'name' => 'name',
            'categories' => []
        ]);
        $this->assertEquals(
            [
                'name' => 'name'
            ],
            $filter->all()
        );
    }

}
