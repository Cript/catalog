<?php

namespace App\Context\Products\Application\Command\CreateOrUpdateProductFromXML;

final class CreateOrUpdateProductFromXML
{
    public function __construct(
        private readonly string $name,
        private readonly string $description,
        private readonly string $weight,
        private readonly string $categoryName
    ) {}

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function weight(): string
    {
        return $this->weight;
    }

    public function categoryName(): string
    {
        return $this->categoryName;
    }
}
