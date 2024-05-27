<?php

declare(strict_types=1);

namespace App\Payment;

use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

class PaymentProcessorFactory
{
    public function make(PaymentProcessorType $type): PaymentProcessor
    {
        if (PaymentProcessorType::Stripe === $type) {
            return new StripePaymentProcessorAdapter(new StripePaymentProcessor());
        }

        return new PaypalPaymentProcessorAdapter(new PaypalPaymentProcessor());
    }
}