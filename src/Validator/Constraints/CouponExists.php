<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use App\Validator\CouponExistsValidator;
use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute(Attribute::TARGET_PROPERTY)]
class CouponExists extends Constraint
{

    public string $message = 'coupon.not_found';

    public function validatedBy(): string
    {
        return CouponExistsValidator::class;
    }
}