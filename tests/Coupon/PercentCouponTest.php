<?php

declare(strict_types=1);

namespace App\Tests\Coupon;

use App\Entity\PercentCoupon;
use App\ValueObject\ProductPrice;
use PHPUnit\Framework\TestCase;

class PercentCouponTest extends TestCase
{
    /**
     * @dataProvider applyProvider
     */
    public function testApply(int $price, string $coupon, float $priceWithCoupon): void
    {
        $price = new ProductPrice($price);

        $coupon = (new PercentCoupon())->setCode($coupon);

        $this->assertEquals(new ProductPrice($priceWithCoupon), $coupon->apply($price));
    }

    public function applyProvider(): array
    {
        return [
            '0 percent' => [
                'price' => 10,
                'coupon' => 'P0',
                'priceWithCoupon' => 10,
            ],
            '10 percent' => [
                'price' => 10,
                'coupon' => 'P10',
                'priceWithCoupon' => 9,
            ],
            '5 percent' => [
                'price' => 10,
                'coupon' => 'P5',
                'priceWithCoupon' => 9.5,
            ],
            '6 percent' => [
                'price' => 10,
                'coupon' => 'P6',
                'priceWithCoupon' => 9.4,
            ],
            '100 percent' => [
                'price' => 10,
                'coupon' => 'P100',
                'priceWithCoupon' => 0,
            ],
        ];
    }
}