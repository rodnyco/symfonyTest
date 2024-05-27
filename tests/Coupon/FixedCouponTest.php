<?php

declare(strict_types=1);

namespace App\Tests\Coupon;

use App\Entity\FixedCoupon;
use App\ValueObject\ProductPrice;
use PHPUnit\Framework\TestCase;

class FixedCouponTest extends TestCase
{
    /**
     * @dataProvider applyProvider
     */
    public function testApply(int $price, string $coupon, float $priceWithCoupon): void
    {
        $price = new ProductPrice($price);

        $coupon = (new FixedCoupon())->setCode($coupon);

        $this->assertEquals(new ProductPrice($priceWithCoupon), $coupon->apply($price));
    }

    public function applyProvider(): array
    {
        return [
            '0 eur' => [
                'price' => 10,
                'coupon' => 'F0',
                'priceWithCoupon' => 10,
            ],
            '5 eur' => [
                'price' => 10,
                'coupon' => 'F5',
                'priceWithCoupon' => 5,
            ],
            '10 eur' => [
                'price' => 10,
                'coupon' => 'F10',
                'priceWithCoupon' => 0,
            ],
            '100 eur' => [
                'price' => 10,
                'coupon' => 'F100',
                'priceWithCoupon' => 0,
            ],
        ];
    }
}