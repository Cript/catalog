<?php

namespace App\Context\Elasticsearch\Domain;

interface RepositoryInterface
{
    public function create(string $id, string $name, string $description, int $weight, string $categoryId);
    public function update(string $id, string $name, string $description, int $weight, string $categoryId);
    public function load(string $name, int $minWeight, int $maxWeight, string $categoryId);
}
