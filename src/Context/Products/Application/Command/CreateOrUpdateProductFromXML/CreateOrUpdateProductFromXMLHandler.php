<?php

namespace App\Context\Products\Application\Command\CreateOrUpdateProductFromXML;

use App\Context\Products\Domain\Category;
use App\Context\Products\Domain\CategoryRepositoryInterface;
use App\Context\Products\Domain\Product;
use App\Context\Products\Domain\ProductRepositoryInterface;
use App\Context\Products\Domain\ValueObject\Name;
use App\Context\Products\Domain\ValueObject\Weight;
use App\Context\Shared\Application\Bus\Command\CommandHandlerInterface;

final class CreateOrUpdateProductFromXMLHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly ProductRepositoryInterface $repository,
        private readonly CategoryRepositoryInterface $categoryRepository
    ) {}

    public function __invoke(CreateOrUpdateProductFromXML $command): void
    {
        $name = Name::fromString($command->name());
        $weight = Weight::fromString($command->weight());
        $category = $this->checkCategory($command->categoryName());

        $product = $this->repository->loadByName($command->name());

        if (null === $product) {
            $product = Product::createFromXML($name, $command->description(), $weight, $category);
            $this->repository->create($product);
        } else {
            $product->updateFromXML(
                $name, $command->description(), $weight, $category
            );
            $this->repository->update($product);
        }
    }

    private function checkCategory(string $name): Category {
        $category = $this->categoryRepository->getByName($name);

        if (!$category) {
            $name = Name::create($name);
            $category = Category::create($name);
            $this->categoryRepository->save($category);
        }

        return $category;
    }
}
