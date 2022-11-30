<?php

namespace App\Context\Products\Infrastructure;

use App\Context\Products\Domain\Product;
use App\Context\Products\Domain\ProductRepositoryInterface;
use App\Context\Shared\Infrastructure\InMemoryAbstractRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

class ProductInMemoryRepository extends InMemoryAbstractRepository implements ProductRepositoryInterface
{
    public function load(int $page, int $limit, string $category): array
    {
        return [];
    }

    public function getByName(string $name): ?Product
    {
        $products = array_filter($this->items, function (Product $product) use ($name) {
            $productName = (new \ReflectionObject($product))->getProperty('name')->getValue($product);

            if ($productName->value() === $name) {
                return true;
            }

            return false;
        });

        if (empty($products)) {
            return null;
        }

        return array_shift($products);
    }

    public function save(Product $product): void
    {
        $this->add($product);
    }
}
