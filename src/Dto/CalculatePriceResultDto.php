<?php

declare(strict_types=1);

namespace App\Dto;

class CalculatePriceResultDto
{
    public function __construct(
        public float $price,
        public float $priceWithCoupon,
        public float $priceWithTax,
        public float $totalPrice,
    )
    {
    }
}