<?php

namespace App\Context\Products\Infrastructure;

use App\Context\Products\Domain\Category;
use App\Context\Products\Domain\CategoryRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

class CategoryDoctrineRepository extends ServiceEntityRepository implements CategoryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function getByName(string $name): ?Category
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        try {
            $category = $qb
                ->select('c')
                ->from(Category::class, 'c')
                ->where('c.name.value = ?1')
                ->setParameter(1, $name, \PDO::PARAM_STR)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $exception) {
            return null;
        }

        return $category;
    }

    public function save(Category $category): void
    {
        $this->getEntityManager()->persist($category);
        $this->getEntityManager()->flush($category);
    }

    public function all(): array
    {
        $qb = $this->getEntityManager()->getConnection();

        return $qb->executeQuery(
            'SELECT c.id, c.name FROM category c ORDER BY c.name ASC'
        )->fetchAllAssociative();
    }
}
