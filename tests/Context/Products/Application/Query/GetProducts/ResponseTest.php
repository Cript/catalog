<?php

declare(strict_types=1);

namespace App\Tests\Context\Products\Application\Query\GetProducts;

use App\Context\Products\Application\Query\GetProducts\Response;
use PHPUnit\Framework\TestCase;

final class ResponseTest extends TestCase
{
    public function testConstructSuccess(): void
    {
        $total = 100;
        $products = [[
            'id' => 'product_id'
        ]];
        $response = new Response($total, $products);

        $this->assertEquals($total, $response->total());
        $this->assertEquals($products, $response->products());
    }
}
