<?php

namespace App\Controller;

use App\Context\Products\Application\Query\Filter;
use App\Context\Products\Application\Query\GetAggregates\GetAggregates;
use App\Context\Products\Application\Query\GetCategories\GetCategories;
use App\Context\Products\Application\Query\GetProducts\GetProducts;
use App\Context\Products\Application\Query\Sorting;
use App\Context\Shared\Application\Bus\Query\QueryBusInterface;
use App\Form\Type\FilterType;
use Pagerfanta\Adapter\FixedAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class CatalogController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function __invoke(
        Request $request,
        QueryBusInterface $queryBus
    ) {
        $requestFilter = $request->query->all()['filter'] ?? [];
        $filter = new Filter([
            'name' => $requestFilter['name'] ?? null,
            'categories' => $requestFilter['categories']['categories'] ?? null,
            'weight' => $requestFilter['weight'] ?? null
        ]);
        $page = $request->query->get('page', 1);
        $sorting = new Sorting($requestFilter['sort_by'] ?? null);

        $categories = $this->loadCategories($queryBus);
        $aggregates = $this->loadAggregates($queryBus, $filter);
        $products = $this->loadProducts($queryBus, $filter, $page, $sorting);

        $filterForm = $this->createForm(FilterType::class, null, [
            'categories' => $categories,
            'aggregates' => $aggregates->aggregates()
        ]);
        $filterForm->handleRequest($request);

        $pagerfanta = new Pagerfanta(new FixedAdapter($products->total(), []));
        $pagerfanta->setCurrentPage($page);

        return $this->render('index.html.twig', [
            'filterForm' => $filterForm->createView(),
            'products' => $products->products(),
            'categories' => $categories,
            'pager' => $pagerfanta
        ]);
    }

    private function loadCategories(QueryBusInterface $queryBus)
    {
        $command = new GetCategories();
        return $queryBus->ask($command);
    }

    private function loadAggregates(QueryBusInterface $queryBus, Filter $filter)
    {
        $query = new GetAggregates($filter);
        return $queryBus->ask($query);
    }

    private function loadProducts(QueryBusInterface $queryBus, Filter $filter, int $page, Sorting $sorting)
    {
        $query = new GetProducts($filter, $page - 1, $sorting);
        return $queryBus->ask($query);
    }
}
