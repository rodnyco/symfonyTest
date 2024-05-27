<?php

declare(strict_types=1);

namespace App\Dto;

use App\Validator\CouponConstraint;
use App\Validator\PaymentProcessorConstraint;
use App\Validator\TaxNumberConstraint;
use Symfony\Component\Validator\Constraints;

class CreatePurchaseDto
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

        #[Constraints\NotBlank]
        #[PaymentProcessorConstraint]
        public string $paymentProcessor,
    ) {}
}