<?php

namespace App\Context\Products\Domain\ValueObject;

use App\Context\Products\Domain\Error\WeightError;
use App\Context\Shared\Domain\DefaultValueObject;
use App\Context\Shared\Domain\DomainObjectInterface;

final class Weight extends DefaultValueObject
{
    const UNITS = ['g', 'kg'];

    private function __construct(
        private readonly int $weight,
        private readonly string $unit
    ) {}

    static function fromString(string $weightStr): Weight {
        $weight = explode(' ', $weightStr);

        if (count($weight) !== 2) {
            throw new WeightError($weightStr);
        }

        list($weight, $unit) = $weight;

        if (!filter_var($weight, FILTER_VALIDATE_INT, [
            'options' => array(
                'min_range' => 1
            ),
        ])) {
            throw new WeightError($weightStr);
        }

        if (!in_array($unit, static::UNITS)) {
            throw new WeightError($weightStr);
        }

        return new Weight($weight, $unit);
    }

    static function fromGram(int $weight): Weight {
        return new Weight($weight, 'g');
    }

    public function asInteger() {
        switch ($this->unit) {
            case 'kg':
                return $this->weight * 1000;
            default:
                return $this->weight;
        }
    }
}
