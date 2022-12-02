<?php

namespace App\Context\Products\Application\Query\GetProducts;

use App\Context\Elasticsearch\Application\Query\GetProducts\GetProducts as ElasticsearchGetProducts;
use App\Context\Elasticsearch\Application\Query\GetProducts\Response;
use App\Context\Products\Domain\ProductRepositoryInterface;
use App\Context\Shared\Application\Bus\Query\QueryBusInterface;
use App\Context\Shared\Application\Bus\Query\QueryHandlerInterface;

final class GetProductsHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
        private readonly ProductRepositoryInterface $productRepository
    ) {}

    public function __invoke(GetProducts $query): Response
    {
        $filteredData = $this->getFilteredData($query);

        $products = $this->productRepository->findByIds($filteredData->products());

        $response = new Response($filteredData->total(), $products);

        return $response;
    }

    private function getFilteredData(GetProducts $query): Response
    {
        $perPage = 10;
        $query = new ElasticsearchGetProducts($query->filter(), $query->page(), $perPage);
        return $this->queryBus->ask($query);
    }
}
