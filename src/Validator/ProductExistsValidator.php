<?php

declare(strict_types=1);

namespace App\Validator;

use App\Repository\ProductRepository;
use App\Validator\Constraints\ProductExists;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ProductExistsValidator extends ConstraintValidator
{
    public function __construct(
        private ProductRepository $productRepository,
    )
    {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof ProductExists) {
            throw new UnexpectedTypeException($constraint, ProductExists::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        if (!is_string($value)) {
            return;
        }

        if (!$this->productRepository->find($value)) {
            $this->context
                ->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}