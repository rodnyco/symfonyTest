<?php

declare(strict_types=1);

namespace App\Tests\Payment;

use App\Payment\PaymentProcessorFactory;
use App\Payment\PaymentProcessorType;
use App\Payment\PaypalPaymentProcessorAdapter;
use App\Payment\StripePaymentProcessorAdapter;
use PHPUnit\Framework\TestCase;

class PaymentProcessorFactoryTest extends TestCase
{
    public function testMake(): void
    {
        $factory = new PaymentProcessorFactory();

        $paypal = PaymentProcessorType::Paypal;
        $stripe = PaymentProcessorType::Stripe;

        $this->assertInstanceOf(PaypalPaymentProcessorAdapter::class, $factory->make($paypal));
        $this->assertInstanceOf(StripePaymentProcessorAdapter::class, $factory->make($stripe));
    }
}