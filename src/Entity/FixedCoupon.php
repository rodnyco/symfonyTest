<?php

declare(strict_types=1);

namespace App\Entity;

use App\ValueObject\ProductPrice;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class FixedCoupon extends Coupon
{
    public function apply(ProductPrice $price): ProductPrice
    {
        $result = $price->getValue() - $this->extractFixedNumber();

        if ($result < 0) {
            return new ProductPrice(0);
        }

        return new ProductPrice($result);
    }

    private function extractFixedNumber(): int
    {
        return (int) substr($this->code, 1);;
    }
}