<?php

namespace App\Context\Products\Infrastructure;

use App\Context\Products\Domain\Category;
use App\Context\Products\Domain\CategoryRepositoryInterface;
use App\Context\Shared\Infrastructure\InMemoryAbstractRepository;

class CategoryInMemoryRepository extends InMemoryAbstractRepository implements CategoryRepositoryInterface
{
    public function getByName(string $name): ?Category
    {
        $categories = array_filter($this->items, function (Category $category) use ($name) {
            $categoryName = (new \ReflectionObject($category))->getProperty('name')->getValue($category);

            if ($categoryName->value() === $name) {
                return true;
            }

            return false;
        });

        if (empty($categories)) {
            return null;
        }

        return array_shift($categories);
    }

    public function save(Category $category): void
    {
        $this->add($category);
    }

    public function all(): array
    {
        $categories = [];
        /**
         * @var Category $category
         */
        foreach ($this->items as $category) {
            $categories[] = [
                'id' => $category->id()->toRfc4122(),
                'name' => $category->name()->value()
            ];
        }

        return $categories;
    }
}
