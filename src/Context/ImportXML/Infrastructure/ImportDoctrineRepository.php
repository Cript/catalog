<?php

namespace App\Context\ImportXML\Infrastructure;

use App\Context\ImportXML\Domain\Import;
use App\Context\ImportXML\Domain\ImportRepositoryInterface;
use App\Context\ImportXML\Domain\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ImportDoctrineRepository extends ServiceEntityRepository implements ImportRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Import::class);
    }

    public function save(Import $import)
    {
        $this->getEntityManager()->persist($import);
        $this->getEntityManager()->flush($import);
    }

    public function addProductToImport(Product $product)
    {
        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush($product);
    }
}
