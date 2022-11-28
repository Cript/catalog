<?php

namespace App\Controller;

use App\Context\Products\Application\Query\GetProducts\GetProducts;
use App\Context\Shared\Application\Bus\Query\QueryBusInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class CatalogController
{
    #[Route('/', name: 'catalog', methods: ['GET'])]
    public function __invoke(
        QueryBusInterface $queryBus
    ) {
        $query = new GetProducts(0, 10);
        $result = $queryBus->ask($query);

        return new Response("Catalog");
    }
}
