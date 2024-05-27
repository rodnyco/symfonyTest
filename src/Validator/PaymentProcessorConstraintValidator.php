<?php

declare(strict_types=1);

namespace App\Validator;

use App\Payment\PaymentProcessorType;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class PaymentProcessorConstraintValidator extends ConstraintValidator
{
    /**
     * @inheritDoc
     */
    public function validate(mixed $value, Constraint $constraint)
    {
        if (!$constraint instanceof PaymentProcessorConstraint) {
            throw new UnexpectedTypeException($constraint, PaymentProcessorConstraint::class);
        }

        $types = array_map(fn(PaymentProcessorType $type) => $type->value, PaymentProcessorType::cases());

        if (in_array($value, $types)) {
            return;
        }

        $this->context
            ->buildViolation($constraint->message)
            ->setParameter('types', implode(", ", $types))
            ->addViolation();
    }
}