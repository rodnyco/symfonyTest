<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class PaymentProcessorConstraint extends Constraint
{
    public string $message = "Unsupported payment type, choose one of: types.";
}