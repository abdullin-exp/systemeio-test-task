<?php

declare(strict_types=1);

namespace App\Validator;

use App\Enum\CountryCode;
use App\Validator\Constraints\TaxNumber;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class TaxNumberValidator extends ConstraintValidator
{
    public const array PATTERNS = [
        CountryCode::GERMANY->value => '/^DE\d{9}$/',
        CountryCode::ITALY->value   => '/^IT\d{11}$/',
        CountryCode::FRANCE->value  => '/^FR[A-Z]{2}\d{9}$/',
        CountryCode::GREECE->value  => '/^GR\d{9}$/',
    ];

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

        $countryCode = substr($value, 0, 2);

        if (!isset(self::PATTERNS[$countryCode])) {
            $this->context
                ->buildViolation($constraint->unknownCountryMessage)
                ->addViolation();
            return;
        }

        $pattern = self::PATTERNS[$countryCode];

        if (!preg_match($pattern, $value)) {
            $this->context
                ->buildViolation($constraint->invalidFormatMessage)
                ->addViolation();
        }
    }
}