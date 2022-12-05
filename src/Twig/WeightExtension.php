<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class WeightExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('weight', [$this, 'formatWeight']),
        ];
    }

    public function formatWeight(int $weight): string
    {
        if ($weight < 1000) {
            return sprintf('%s g', $weight);
        }

        return sprintf('%s kg', $weight / 1000);
    }
}
