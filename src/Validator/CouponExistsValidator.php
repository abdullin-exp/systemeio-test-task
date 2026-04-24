<?php

declare(strict_types=1);

namespace App\Validator;

use App\Repository\CouponRepository;
use App\Validator\Constraints\CouponExists;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class CouponExistsValidator extends ConstraintValidator
{
    public function __construct(
        private CouponRepository $couponRepository,
    )
    {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof CouponExists) {
            throw new UnexpectedTypeException($constraint, CouponExists::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        if (!is_string($value)) {
            return;
        }

        if (!$this->couponRepository->find($value)) {
            $this->context
                ->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}