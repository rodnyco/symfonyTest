<?php

declare(strict_types=1);

namespace App\Tests\Tax;

use App\Entity\CountryTax;
use App\ValueObject\ProductPrice;
use PHPUnit\Framework\TestCase;

class CountryTaxTest extends TestCase
{
    /**
     * @dataProvider applyProvider
     */
    public function testApply(int $price, int $tax, $priceWithTax): void
    {
        $price = new ProductPrice($price);

        $tax = (new CountryTax())->setTaxValue($tax);

        $this->assertEquals(new ProductPrice($priceWithTax), $tax->apply($price));
    }

    public function applyProvider(): array
    {
        return [
            [
                'price' => 100,
                'taxValue' => 24,
                'priceWithTax' => 124,
            ],
            [
                'price' => 10,
                'taxValue' => 8,
                'priceWithTax' => 10.8,
            ],
        ];
    }
}