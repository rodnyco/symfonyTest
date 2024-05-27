<?php

declare(strict_types=1);

namespace App\Payment;

use App\ValueObject\ProductPrice;

interface PaymentProcessor
{
    public function pay(ProductPrice $price): bool;
}