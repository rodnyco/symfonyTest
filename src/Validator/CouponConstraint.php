<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class CouponConstraint extends Constraint
{
    public string $message = 'The coupon is specified in the wrong format';
}