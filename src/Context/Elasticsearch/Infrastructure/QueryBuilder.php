<?php

namespace App\Context\Elasticsearch\Infrastructure;

class QueryBuilder
{
    public function buildQuery(array $filter): array
    {
        $query = [];
        $queryFilter = $this->buildFilter($filter);

        if (!empty($queryFilter)) {
            $query["bool"] = [
                "filter" => $queryFilter,
            ];
        }

        return $query;
    }

    private function buildFilter(array $filter): array
    {
        $must = [];

        if (isset($filter['name'])) {
            $must[] = [
                "match" => [
                    "name" => $filter['name']
                ]
            ];
        }

        if (!empty($filter['weight'])) {
            $weight = [];

            if (!empty($filter['weight']['min'])) {
                $weight['gte'] = $filter['weight']['min'];
            }
            if (!empty($filter['weight']['max'])) {
                $weight['lte'] = $filter['weight']['max'];
            }

            $must[] = [
                "range" => [
                    "weight" => $weight
                ]
            ];
        }

        if (isset($filter['categories'])) {
            $must[] = [
                "terms" => [
                    "category" => $filter['categories']
                ]
            ];
        }

        return $must;
    }

    public function buildAggs()
    {
        return [
            "min_weight" => [
                "min" => [
                    "field" => "weight"
                ]
            ],
            "max_weight" => [
                "max" => [
                    "field" => "weight"
                ]
            ],
            "categories" => [
                "terms" => [
                    "size" => 1000,
                    "field" => "category"
                ]
            ]
        ];
    }
}
