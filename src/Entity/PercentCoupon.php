<?php

declare(strict_types=1);

namespace App\Entity;

use App\ValueObject\ProductPrice;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class PercentCoupon extends Coupon
{
    public function apply(ProductPrice $price): ProductPrice
    {
        return new ProductPrice(
            $price->getValue() - ($price->getValue() * ($this->extractPercent() / 100))
        );
    }

    private function extractPercent(): int
    {
        return (int) substr($this->code, 1);
    }
}