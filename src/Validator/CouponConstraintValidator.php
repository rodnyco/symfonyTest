<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class CouponConstraintValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint)
    {
        if (!$constraint instanceof CouponConstraint) {
            throw new UnexpectedTypeException($constraint, CouponConstraint::class);
        }

        if (preg_match('/[PF]\d+$/', $value, $matches)) {
            return;
        }

        $this->context->buildViolation($constraint->message)->addViolation();
    }
}