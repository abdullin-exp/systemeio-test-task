<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute(Attribute::TARGET_PROPERTY)]
class TaxNumber extends Constraint
{
    public string $invalidFormatMessage = 'taxNumber.invalid_format';

    public string $unknownCountryMessage = 'taxNumber.unknown_country';
}