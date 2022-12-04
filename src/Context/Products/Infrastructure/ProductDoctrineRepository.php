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

    public function loadByName(string $name): ?Product
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

    public function create(Product $product): void
    {
        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush($product);
    }

    public function update(Product $product): void
    {
        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush($product);
    }
}
