<?php

declare(strict_types=1);

namespace App\Tests\Price;

use App\ValueObject\ProductPrice;
use PHPUnit\Framework\TestCase;

class ProductPriceTest extends TestCase
{
    /**
     * @dataProvider toSmallestUnitProvider
     */
    public function testToSmallesUnit(float $input, int $expected): void
    {
        $price = new ProductPrice($input);

        $this->assertEquals($expected, $price->toSmallesUnit());
    }

    public function toSmallestUnitProvider(): array
    {
        return [
            [
                'input' => 0,
                'expected' => 0,
            ],
            [
                'input' => 10,
                'expected' => 1000,
            ],
            [
                'input' => 58.32,
                'expected' => 5832,
            ],
        ];
    }
}