<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use App\Validator\ProductExistsValidator;
use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute(Attribute::TARGET_PROPERTY)]
class ProductExists extends Constraint
{

    public string $message = 'product.not_found';

    public function validatedBy(): string
    {
        return ProductExistsValidator::class;
    }
}