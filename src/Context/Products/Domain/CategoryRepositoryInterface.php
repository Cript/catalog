<?php

namespace App\Context\Products\Domain;

interface CategoryRepositoryInterface
{
    public function getByName(string $name): ?Category;
    public function save(Category $category): void;
}
