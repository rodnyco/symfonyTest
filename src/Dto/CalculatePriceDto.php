<?php

declare(strict_types=1);

namespace App\Price\Dto;

use App\Validator\CouponConstraint;
use App\Validator\TaxNumberConstraint;
use Symfony\Component\Validator\Constraints;

class CalculatePriceDto
{
    public function __construct(
        #[Constraints\NotBlank]
        public int $product,

        #[Constraints\NotBlank]
        #[TaxNumberConstraint]
        public string $taxNumber,

        #[Constraints\NotBlank]
        #[CouponConstraint]
        public string $couponCode,
    ) {}
}