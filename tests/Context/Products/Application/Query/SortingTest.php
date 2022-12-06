<?php

declare(strict_types=1);

namespace App\Tests\Context\Products\Application\Query;

use App\Context\Products\Application\Query\Sorting;
use PHPUnit\Framework\TestCase;

final class SortingTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testSorting(?string $sorting, ?string $sortBy, ?string $sortOrder): void
    {
        $sorting = new Sorting($sorting);
        $this->assertEquals($sortBy, $sorting->sortBy());
        $this->assertEquals($sortOrder, $sorting->sortOrder());
    }

    public function dataProvider(): array
    {
        return [
            [null, null, null],
            ['default', null, null],
            ['weight_asc', 'weight', 'asc'],
            ['weight_desc', 'weight', 'desc'],
        ];
    }
}
