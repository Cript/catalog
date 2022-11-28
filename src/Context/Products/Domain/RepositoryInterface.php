<?php

namespace App\Context\Products\Domain;

interface RepositoryInterface
{
    public function load($page, $limit): array;
}
