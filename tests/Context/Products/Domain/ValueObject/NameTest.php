<?php

declare(strict_types=1);

namespace App\Tests\Context\Products\Domain\ValueObject;

use App\Context\Products\Domain\Error\NameError;
use App\Context\Products\Domain\ValueObject\Name;
use PHPUnit\Framework\TestCase;

final class NameTest extends TestCase
{
    /**
     * @dataProvider successProvider
     */
    public function testFromStringSuccess(string $name): void
    {
        $name = Name::fromString($name);

        $this->assertInstanceOf(Name::class, $name);
    }

    /**
     * @dataProvider errorsProvider
     */
    public function testFromStringThrowsException(string $name): void
    {
        $this->expectException(NameError::class);

        Name::fromString($name);
    }

    public function successProvider(): array {
        return [
            ['Alex'],
            ['Rob ert'],
        ];
    }

    public function errorsProvider(): array {
        return [
            [''],
            ['     ']
        ];
    }
}
