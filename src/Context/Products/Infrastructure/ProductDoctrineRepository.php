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

//    public function load(int $page, int $limit, ?string $categoryId = null, ?int $weight = null): array
//    {
//        $connection = $this->getEntityManager()->getConnection();
//
//        $qb = $connection->createQueryBuilder();
//
//        $qb->addSelect('p.id, p.description, p.name, p.weight, c.id as category_id, c.name as category_name')
//            ->from('product', 'p')
//            ->setFirstResult($page * $limit)
//            ->setMaxResults($limit);
//
//        $this->filterByCategory($qb, $categoryId);
//        $this->filterByWeight($qb, $weightMin, $weightMax);
//
//        return $qb->fetchAllAssociative();
//    }

//    private function filterByCategory(QueryBuilder $qb, ?string $categoryId): void
//    {
//        if (null !== $categoryId) {
//            $joinOn = $qb->expr()->and(
//                $qb->expr()->eq('c.id', 'p.category_id'),
//                $qb->expr()->eq('c.name', ':category_id')
//            );
//            $qb->setParameter('category_id', $categoryId);
//
//        } else {
//            $joinOn = $qb->expr()->and(
//                $qb->expr()->eq('c.id', 'p.category_id')
//            );
//        }
//
//        $qb->innerJoin('p', 'category', 'c', $joinOn);
//    }

    private function filterByWeight(QueryBuilder $qb, ?int $weightMin, ?int $weightMax)
    {
//        if(null !== $weight) {
//            $qb->where('p.weight')
//        }
    }
}
