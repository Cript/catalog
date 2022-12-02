<?php

namespace App\Context\Elasticsearch\Infrastructure;

use App\Context\Elasticsearch\Application\Query\GetAggregates\Response as AggregatesResponse;
use App\Context\Elasticsearch\Application\Query\GetProducts\Response as ProductsResponse;
use App\Context\Elasticsearch\Domain\RepositoryInterface;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;

final class ElasticSearchRepository implements RepositoryInterface
{
    private const INDEX_NAME = 'product';

    private Client $client;

    public function __construct(
        private readonly QueryBuilder $queryBuilder
    ) {
        $this->client = $this->buildClient();
    }

    public function create(string $id, string $name, string $description, int $weight, string $categoryId)
    {
        $client = $this->buildClient();

        $params = [
            'index' => self::INDEX_NAME,
            'id' => $id,
            'body'  => [
                'name' => $name,
                'description' => $description,
                'weight' => $weight,
                'category' => $categoryId
            ]
        ];

        $client->index($params);
    }

    public function update(string $id, string $name, string $description, int $weight, string $categoryId)
    {
        $client = $this->buildClient();

        $params = [
            'index' => self::INDEX_NAME,
            'id' => $id,
            'body'  => [
                'doc' => [
                    'name' => $name,
                    'description' => $description,
                    'weight' => $weight,
                    'category' => $categoryId
                ]
            ]
        ];

        $client->update($params);
    }

    public function aggregates(?array $filter): array {
        $params = [
            'index' => self::INDEX_NAME,
            'body'  => [
                'size' => 0,
                "aggs" => $this->queryBuilder->buildAggs()
            ]
        ];

        $query = $this->queryBuilder->buildQuery($filter);
        if (!empty($query)) {
            $params['body']['query'] = $query;
        }

        $result = $this->client->search($params);

        $aggregates = [
            'min_weight' => $result['aggregations']['min_weight']['value'],
            'max_weight' => $result['aggregations']['max_weight']['value'],
            'categories' => array_combine(
                array_column($result['aggregations']['categories']['buckets'], 'key'),
                array_column($result['aggregations']['categories']['buckets'], 'doc_count')
            )
        ];

        return $aggregates;
    }

    public function products(?array $filter, int $page, int $perPage): ProductsResponse
    {
        $params = [
            'index' => self::INDEX_NAME,
            'body'  => [
                'from' => $page * $perPage,
                'size' => $perPage
            ]
        ];

        if(null !== $filter) {
            $query = $this->queryBuilder->buildQuery($filter);
            if (!empty($query)) {
                $params['body']['query'] = $query;
            }
        }

        $result = $this->client->search($params);

        return new ProductsResponse(
            $result['hits']["total"]["value"],
            array_column($result['hits']['hits'], '_id')
        );
    }

    private function buildClient(): Client
    {
        return ClientBuilder::create()
            ->setHosts(['elasticsearch:9200'])
            ->build();
    }

}
