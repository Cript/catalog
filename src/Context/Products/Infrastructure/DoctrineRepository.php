<?php

namespace App\Context\Products\Infrastructure;

use App\Context\Products\Domain\Product;
use App\Context\Products\Domain\RepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineRepository extends ServiceEntityRepository implements RepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function load($page, $limit): array
    {
        $connection = $this->getEntityManager()->getConnection();

        return $connection->executeQuery('SELECT * FROM product')->fetchAllAssociative();
    }
}
