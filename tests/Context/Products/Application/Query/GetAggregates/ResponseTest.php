<?php

declare(strict_types=1);

namespace App\Tests\Context\Products\Application\Query\GetAggregates;

use App\Context\Products\Application\Query\GetAggregates\Response;
use PHPUnit\Framework\TestCase;

final class ResponseTest extends TestCase
{
    public function testConstructSuccess(): void
    {
        $aggregates = [];
        $response = new Response([]);

        $this->assertEquals($aggregates, $response->aggregates());
    }
}
