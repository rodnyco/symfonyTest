<?php

namespace App\Payment;

use App\ValueObject\ProductPrice;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

class StripePaymentProcessorAdapter implements PaymentProcessor
{
    public function __construct(private readonly StripePaymentProcessor $processor)
    {
    }

    public function pay(ProductPrice $price): bool
    {
        return $this->processor->processPayment($price->getValue());
    }
}