<?php

namespace App\Context\Products\Application\Query;

class Sorting
{
    private ?string $sortBy;
    private ?string $sortOrder;

    public function __construct(?string $sorting)
    {
        if (null === $sorting) {
            $sorting = 'default';
        }

        if ('default' === $sorting) {
            $this->sortBy = null;
            $this->sortOrder = null;
        } else {
            list($this->sortBy, $this->sortOrder) = explode('_', $sorting);
        }
    }

    public function sortBy(): ?string
    {
        return $this->sortBy;
    }

    public function sortOrder(): ?string
    {
        return $this->sortOrder;
    }
}
