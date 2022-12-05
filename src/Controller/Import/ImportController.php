<?php

namespace App\Controller\Import;

use App\Context\Shared\Application\Bus\Query\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class ImportController extends AbstractController
{
    #[Route('/import', name: 'import', methods: ['GET'])]
    public function __invoke(
        Request $request,
        QueryBusInterface $queryBus
    ) {

        return $this->render('import.html.twig', [

        ]);
    }
}
