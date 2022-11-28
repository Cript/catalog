<?php

declare(strict_types=1);

namespace App\Tests\Context\Products\Application\Query\GetProducts;

use App\Context\Products\Application\Query\GetProducts\GetProducts;
use App\Context\Products\Application\Query\GetProducts\GetProductsHandler;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class GetProductsHandlerTest extends KernelTestCase
{
    public function testSuccessfulResponse(): void
    {
        $this->bootKernel();

        /**
         * @var GetProductsHandler $handler
         */
        $handler = static::$kernel->getContainer()->get('test.App\Context\Products\Application\Query\GetProducts\GetProductsHandler');
        $query = new GetProducts(0, 10);

        call_user_func($handler, $query);
    }
}
