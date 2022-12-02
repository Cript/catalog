<?php

namespace App\Context\Elasticsearch\Domain;

class Filter
{
    private array $validFilters = [
        'name' => null,
        'categories' => null,
        'weight' => [
            'min' => null,
            'max' => null
        ]
    ];

    private array $filters = [];

    public function __construct(array $filters)
    {
        $filters = array_intersect_key($filters, $this->validFilters);
        $this->filters = array_merge($this->validFilters, $filters);
    }

    public function exists(string $name): bool
    {
        return null !== $this->filters[$name] && !empty($this->filters[$name]);
    }

    public function without(string $name): array
    {
        return $this->filterEmpty(
            array_filter($this->filters, fn ($key) => $key !== $name, ARRAY_FILTER_USE_KEY)
        );
    }

    public function all(): array
    {
        return $this->filterEmpty($this->filters);
    }

    private function filterEmpty(array $filters): array
    {
        return array_filter($filters, function($value) use ($filters) {
            return !empty($value);
        });
    }
}
