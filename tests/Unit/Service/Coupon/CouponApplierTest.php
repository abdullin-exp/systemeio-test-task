<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service\Coupon;

use App\Entity\Coupon;
use App\Enum\CouponType;
use App\Service\Coupon\CouponApplier;
use PHPUnit\Framework\TestCase;

class CouponApplierTest extends TestCase
{

    public function testCalculatePriceCouponWithout(): void
    {
        $applier = new CouponApplier();

        $result = $applier->apply(1000, null);

        self::assertSame(1000, $result);
    }

    public function testCalculatePriceAbsoluteCoupon(): void
    {
        $applier = new CouponApplier();

        $coupon = new Coupon();
        $coupon->type = CouponType::ABSOLUTE;
        $coupon->discount = 300;

        $result = $applier->apply(1000, $coupon);

        self::assertSame(700, $result);
    }

    public function testCalculatePricePercentCoupon(): void
    {
        $applier = new CouponApplier();

        $coupon = new Coupon();
        $coupon->type = CouponType::PERCENT;
        $coupon->discount = 10;

        $result = $applier->apply(1000, $coupon);

        self::assertSame(900, $result);
    }

    public function testCalculatePriceRoundingCoupon(): void
    {
        $applier = new CouponApplier();

        $coupon = new Coupon();
        $coupon->type = CouponType::PERCENT;
        $coupon->discount = 33;

        $result = $applier->apply(1000, $coupon);

        // 1000 * 0.67 = 670
        self::assertSame(670, $result);
    }
}