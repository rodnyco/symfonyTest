<?php

namespace App\Payment;

use App\ValueObject\ProductPrice;
use Exception;
use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;

class PaypalPaymentProcessorAdapter implements PaymentProcessor
{
    public function __construct(private readonly PaypalPaymentProcessor $processor)
    {
    }

    public function pay(ProductPrice $price): bool
    {
        try {
            $this->processor->pay($price->toSmallesUnit());
        } catch (Exception $e) {
            return false;
        }

        return true;
    }
}