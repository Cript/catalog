<?php

namespace App\Context\Products\Infrastructure;

use App\Context\Products\Domain\ProductIndexRepositoryInterface;
use App\Context\Products\Infrastructure\Elasticsearch\QueryBuilder;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;

final class ProductElasticsearchRepository implements ProductIndexRepositoryInterface
{
    private const INDEX_NAME = 'product';

    private Client $client;

    public function __construct(
        private readonly QueryBuilder $queryBuilder,
        private string $elasticsearchUrl,
        private string $elasticsearchUser,
        private string $elasticsearchPassword,
        private string $yandexCloudCert
    ) {
        $this->client = $this->buildClient();
    }

    public function load(array $filter, int $page, int $perPage, ?string $sortBy, ?string $sortOrder): array
    {
        $params = [
            'index' => self::INDEX_NAME,
            'body'  => [
                'from' => $page * $perPage,
                'size' => $perPage,
                'track_total_hits' => true
            ]
        ];

        if(!empty($filter)) {
            $query = $this->queryBuilder->buildQuery($filter);
            if (!empty($query)) {
                $params['body']['query'] = $query;
            }
        }

        if (!empty($sortBy) && !empty($sortOrder)) {
            $sort = $this->queryBuilder->buildSort($sortBy, $sortOrder);
            $params['body']['sort'] = $sort;
        }

        $result = $this->client->search($params);

        $products = [];

        foreach ($result['hits']['hits'] as $hit) {
            $products[] = array_merge(
                ['id' => $hit['_id']],
                $hit['_source']
            );
        }

        return [
            'total' => $result['hits']["total"]["value"],
            'products' => $products
        ];
    }

    public function create(string $id, string $name, string $description, int $weight, string $categoryId, string $categoryName): void
    {
        $client = $this->buildClient();

        $params = [
            'index' => self::INDEX_NAME,
            'id' => $id,
            'body'  => [
                'name' => $name,
                'description' => $description,
                'weight' => $weight,
                'category' => $categoryId,
                'category_name' => $categoryName
            ]
        ];

        $client->index($params);
    }

    public function update(string $id, string $name, string $description, int $weight, string $categoryId, string $categoryName): void
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
                    'category' => $categoryId,
                    'category_name' => $categoryName
                ]
            ]
        ];

        $client->update($params);
    }

    public function aggregates(array $filter): array {
        $params = [
            'index' => self::INDEX_NAME,
            'body'  => [
                'size' => 0,
                'track_total_hits' => true,
                "aggs" => $this->queryBuilder->buildAggs()
            ]
        ];

        if(!empty($filter)) {
            $query = $this->queryBuilder->buildQuery($filter);
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

    private function buildClient(): Client
    {
        return ClientBuilder::create()
            ->setHosts([$this->elasticsearchUrl])
            ->setCABundle($this->yandexCloudCert)
            ->setSSLVerification()
            ->setBasicAuthentication($this->elasticsearchUser, $this->elasticsearchPassword)
            ->build();
    }

}
