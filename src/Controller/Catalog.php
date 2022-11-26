<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class CatalogController
{
    #[Route('/', name: 'hello', methods: ['GET'])]
    public function index()
    {
        return new Response("Catalog");
    }
}
