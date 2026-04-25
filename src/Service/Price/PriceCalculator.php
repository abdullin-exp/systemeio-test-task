<?php

declare(strict_types=1);

namespace App\Service\Price;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\TaxRate;
use App\Service\Coupon\CouponApplier;
use App\Service\Tax\TaxCalculator;

final readonly class PriceCalculator
{

    public function __construct(
        private CouponApplier $couponApplier,
        private TaxCalculator $taxCalculator,
    )
    {
    }

    public function calculateFinalPrice(
        Product $product,
        TaxRate $taxRate,
        ?Coupon $coupon = null
    ): int
    {
        $price = $this->couponApplier->apply($product->price, $coupon);

        return $this->taxCalculator
            ->calculate($price, $taxRate->rate);
    }
}