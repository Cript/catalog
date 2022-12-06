<?php

declare(strict_types=1);

namespace App\Tests\Context\Products\Application\Query;

use App\Context\Products\Application\Query\Filter;
use PHPUnit\Framework\TestCase;

final class FilterTest extends TestCase
{
    public function testConstructSuccess(): void
    {
        $filterText = 'search_text';
        $categories = ['category_1', 'category_2'];
        $widthMin = 10;
        $widthMax = 20;

        $filter = new Filter([
            'name' => $filterText,
            'categories' => ['category_1', 'category_2'],
            'weight' => [
                'min' => $widthMin,
                'max' => $widthMax
            ]
        ]);

        $this->assertEquals($filterText, $filter->all()['name']);
        $this->assertEquals([
            'min' => $widthMin,
            'max' => $widthMax
        ], $filter->all()['weight']);
        $this->assertEquals($categories, $filter->all()['categories']);
    }

    public function testAll(): void
    {
        $filters = [
            'name' => 'search_text',
            'categories' => ['category_1', 'category_2'],
            'weight' => [
                'min' => 10,
                'max' => 20
            ]
        ];

        $filter = new Filter($filters);

        $this->assertEquals($filters, $filter->all());
    }

    public function testEmptyFilter(): void
    {
        $filter = new Filter([]);

        $this->assertEmpty($filter->all());
    }

    /**
     * @dataProvider withoutDataProvider
     */
    public function testWithout(array $filters, string $without, array $expected): void
    {
        $filter = new Filter($filters);

        $this->assertEquals($expected, $filter->without($without));
    }

    public function withoutDataProvider(): array
    {
        return [
            [
                [
                    'name' => 'search_text',
                    'categories' => ['category_1', 'category_2'],
                    'weight' => [
                        'min' => 10,
                        'max' => 20
                    ]
                ],
                'name',
                [
                    'categories' => ['category_1', 'category_2'],
                    'weight' => [
                        'min' => 10,
                        'max' => 20
                    ]
                ]
            ],
            [
                [
                    'name' => 'search_text',
                    'categories' => ['category_1', 'category_2'],
                    'weight' => [
                        'min' => 10,
                        'max' => 20
                    ]
                ],
                'categories',
                [
                    'name' => 'search_text',
                    'weight' => [
                        'min' => 10,
                        'max' => 20
                    ]
                ]
            ],
            [
                [
                    'name' => 'search_text',
                    'categories' => ['category_1', 'category_2'],
                    'weight' => [
                        'min' => 10,
                        'max' => 20
                    ]
                ],
                'weight',
                [
                    'name' => 'search_text',
                    'categories' => ['category_1', 'category_2'],
                ]
            ]
        ];
    }
}
