<?php

namespace App\Payment;

enum PaymentProcessorType: string
{
    case Paypal = 'paypal';
    case Stripe = 'stripe';
}
