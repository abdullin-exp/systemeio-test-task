<?php

declare(strict_types=1);

namespace App\Validator;

use App\Repository\CouponRepository;
use App\Validator\Constraints\CouponExists;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

final class CouponExistsValidator extends ConstraintValidator
{

    public function __construct(
        private readonly CouponRepository $couponRepository,
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

        $coupon = $this->couponRepository->findOneBy(['code' => $value]);

        if (!$coupon) {
            $this->context
                ->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}