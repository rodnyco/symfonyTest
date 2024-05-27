<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class TaxNumberConstraint extends Constraint
{
    public string $message = 'Tax number is specified in the wrong format';
}