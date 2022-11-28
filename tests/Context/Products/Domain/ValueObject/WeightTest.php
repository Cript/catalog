<?php

declare(strict_types=1);

namespace App\Tests\Context\Products\Domain\ValueObject;

use App\Context\Products\Domain\Error\WeightError;
use App\Context\Products\Domain\ValueObject\Weight;
use PHPUnit\Framework\TestCase;

final class WeightTest extends TestCase
{
    /**
     * @dataProvider successFromStringProvider
     */
    public function testFromStringSuccess(string $weight, int $grams): void
    {
        $weight = Weight::fromString($weight);

        $this->assertInstanceOf(Weight::class, $weight);
        $this->assertEquals($grams, $weight->asInteger());
    }
    /**
     * @dataProvider successFromGramProvider
     */
    public function testFromGramSuccess(int $weight, int $grams): void
    {
        $weight = Weight::fromGram($weight);

        $this->assertInstanceOf(Weight::class, $weight);
        $this->assertEquals($grams, $weight->asInteger());
    }

    /**
     * @dataProvider errorsProvider
     */
    public function testFromStringThrowsException(string $weight, string $error): void
    {
        $this->expectException(WeightError::class);
        $this->expectExceptionMessage($error);

        Weight::fromString($weight);
    }

    public function successFromStringProvider(): array {
        return [
            ['10 g', 10],
            ['10 kg', 10000],
        ];
    }

    public function successFromGramProvider(): array {
        return [
            [10, 10],
            [1000, 1000],
        ];
    }

    public function errorsProvider(): array {
        return [
            ['-10 g', 'Weight -10 g is invalid'],
            ['10 gg', 'Weight 10 gg is invalid'],
            ['10', 'Weight 10 is invalid'],
            ['gr', 'Weight gr is invalid'],
            ['10 gr g', 'Weight 10 gr g is invalid'],
            ['0.5 kg', 'Weight 0.5 kg is invalid'],
            ['0.5 g', 'Weight 0.5 g is invalid'],
            ['-0.5 kg', 'Weight -0.5 kg is invalid'],
        ];
    }
}
