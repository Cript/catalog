<?php

namespace App\Context\Elasticsearch\Infrastructure;

use App\Context\Elasticsearch\Domain\RepositoryInterface;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;

final class ElasticSearchRepository implements RepositoryInterface
{
    private const INDEX_NAME = 'product';

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

    public function load(string $name, int $minWeight, int $maxWeight, string $categoryId)
    {
        // TODO: Implement load() method.
    }

    private function buildClient(): Client
    {
        return ClientBuilder::create()
            ->setHosts(['elasticsearch:9200'])
            ->build();
    }

}
