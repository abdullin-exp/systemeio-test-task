<?php

declare(strict_types=1);

namespace App\Validator;

use App\Enum\CountryCode;
use App\Validator\Constraints\TaxNumber;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Throwable;

final class TaxNumberValidator extends ConstraintValidator
{

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof TaxNumber) {
            throw new UnexpectedTypeException($constraint, TaxNumber::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        if (!is_string($value)) {
            return;
        }

        try {
            $country = CountryCode::from(
                substr($value, 0, 2)
            );
        } catch (Throwable $e) {
            $this->context
                ->buildViolation($constraint->unknownCountryMessage)
                ->addViolation();

            return;
        }

        if (!preg_match($country->taxNumberPatterns(), $value)) {
            $this->context
                ->buildViolation($constraint->invalidFormatMessage)
                ->addViolation();
        }
    }
}