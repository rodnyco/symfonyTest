<?php

namespace App\Validator;

use App\ValueObject\TaxNumber;
use DomainException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class TaxNumberConstraintValidator extends ConstraintValidator
{
    /**
     * @inheritDoc
     */
    public function validate(mixed $value, Constraint $constraint)
    {
        if (!$constraint instanceof TaxNumberConstraint) {
            throw new UnexpectedTypeException($constraint, TaxNumberConstraint::class);
        }

        try {
            new TaxNumber($value);
        } catch (DomainException) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}