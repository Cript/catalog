<?php

declare(strict_types=1);

namespace App\Context\Products\Infrastructure\Doctrine\Type;

use App\Context\Products\Domain\ValueObject\Weight;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

final class WeightType extends Type
{
    public function getName(): string
    {
        return "weight";
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        $platform->getIntegerTypeDeclarationSQL([]);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): mixed
    {
        if (null === $value) {
            return null;
        }

        return Weight::fromGram($value);
    }

    /**
     * @param Weight $value
     * @param AbstractPlatform $platform
     * @return mixed
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->asInteger();
    }

}
