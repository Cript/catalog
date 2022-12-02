<?php

namespace App\Context\Products\Application\Query\GetCategories;

use App\Context\Products\Domain\CategoryRepositoryInterface;
use App\Context\Shared\Application\Bus\Query\QueryHandlerInterface;

final class GetCategoriesHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository
    ) {}

    public function __invoke(GetCategories $query): array
    {
        return $this->categoryRepository->all();
    }
}
