<?php

namespace App\Context\Elasticsearch\Domain;

use App\Context\Elasticsearch\Application\Query\GetProducts\Filter;
use App\Context\Elasticsearch\Application\Query\GetProducts\Navigation;

interface RepositoryInterface
{
    public function create(string $id, string $name, string $description, int $weight, string $categoryId);
    public function update(string $id, string $name, string $description, int $weight, string $categoryId);
    public function aggregates(array $filter): array;
    public function products(array $filter, int $page, int $perPage);
}
