<?php
//
//declare(strict_types=1);
//
//namespace App\Tests\Context\Products\Application\Query\GetProducts;
//
//use App\Context\Products\Application\Query\GetProducts\GetProducts;
//use App\Context\Products\Application\Query\GetProducts\GetProductsHandler;
//use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
//
//final class GetProductsHandlerTest extends KernelTestCase
//{
//    private GetProductsHandler $handler;
//
//    public function setUp(): void
//    {
//        $this->bootKernel();
//        $this->handler = static::$kernel->getContainer()->get('test.App\Context\Products\Application\Query\GetProducts\GetProductsHandler');
//    }
//
//    /**
//     * @dataProvider limitOffsetDataProvider
//     */
////    public function testLimitOffset(int $page, $limit, $count, $lastProductName): void
////    {
////        $query = new GetProducts($page, $limit);
////
////        $result = call_user_func($this->handler, $query);
////
////        $this->assertCount($count, $result);
////        $this->assertEquals($lastProductName, end($result)['name']);
////    }
//
//    /**
//     * @dataProvider categoriesProvider
//     */
//    public function testFilters(int $page, $limit, string $categoryId, $count, $lastProductName): void
//    {
//        $query = new GetProducts($page, $limit, $categoryId);
//
//        $result = call_user_func($this->handler, $query);
//
//        $this->assertEquals($lastProductName, end($result)['name']);
//    }
//
//    public function limitOffsetDataProvider(): array
//    {
//        return [
//            [0, 10, 10, 'product_9'],
//            [4, 10, 5, 'product_44']
//        ];
//    }
//
//    public function categoriesProvider(): array {
//        return [
//            [0, 10, 'category_0', 10, 'product_9'],
//            [1, 10, 'category_0', 10, 'product_14'],
//            [0, 10, 'category_1', 10, 'product_24'],
//            [1, 10, 'category_1', 5, 'product_34'],
//        ];
//    }
//}
