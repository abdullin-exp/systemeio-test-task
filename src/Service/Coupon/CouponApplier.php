<?php

declare(strict_types=1);

namespace App\Service\Coupon;

use App\Entity\Coupon;
use App\Enum\CouponType;

/**
 * Можно применить паттерн стратегию, если появятся новые формулы расчета скидок по купонам
 */
final class CouponApplier
{

    public function apply(int $price, ?Coupon $coupon = null): int
    {
        if (!$coupon) {
            return $price;
        }

        return match ($coupon->type) {
            CouponType::ABSOLUTE => $this->applyAbsolute($price, $coupon),
            CouponType::PERCENT => $this->applyPercent($price, $coupon),
        };
    }

    private function applyAbsolute(int $price, Coupon $coupon): int
    {
        return max(0, $price - $coupon->discount);
    }

    private function applyPercent(int $price, Coupon $coupon): int
    {
        return (int) round(
            $price * (1 - $coupon->discount / 100)
        );
    }
}