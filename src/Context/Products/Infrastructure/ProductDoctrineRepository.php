<?php

namespace App\Context\Products\Infrastructure;

use App\Context\Products\Domain\Product;
use App\Context\Products\Domain\ProductRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

class ProductDoctrineRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function load(int $page, int $limit, string $category): array
    {
        return [];
    }

    public function getByName(string $name): ?Product
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        try {
            $product = $qb
                ->select('p')
                ->from(Product::class, 'p')
                ->where('p.name.value = ?1')
                ->setParameter(1, $name, \PDO::PARAM_STR)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $exception) {
            return null;
        }

        return $product;
    }

    public function save(Product $product): void
    {
        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush($product);
    }

    public function findByIds(array $ids): array
    {
        $qb = $this->getEntityManager()->getConnection()->createQueryBuilder();

        $products = $qb
            ->select('p.id, p.name, p.weight, c.name as category_name')
            ->from('product', 'p')
            ->leftJoin('p', 'category', 'c', 'c.id = p.category_id')
            ->where($qb->expr()->in('p.id', '?'))
            ->setParameter(0, $ids, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY)
            ->fetchAllAssociative();

        return $products;
    }
}
