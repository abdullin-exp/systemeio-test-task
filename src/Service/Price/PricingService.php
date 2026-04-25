<?php

declare(strict_types=1);

namespace App\Service\Price;

use App\Exception\InternalException;
use App\Repository\CouponRepository;
use App\Repository\ProductRepository;
use App\Repository\TaxRateRepository;
use App\Service\Tax\CountryResolver;

final readonly class PricingService
{

    public function __construct(
        private PriceCalculator   $priceCalculator,
        private ProductRepository $productRepository,
        private CouponRepository  $couponRepository,
        private TaxRateRepository $taxRateRepository,
        private CountryResolver   $countryResolver,
    )
    {
    }

    /**
     * @throws InternalException
     */
    public function resolveFinalPrice(
        string $productId,
        string $taxNumber,
        ?string $couponCode = null,
    ): int
    {
        $product = $this->productRepository->find($productId);

        if (!$product) {
            throw new InternalException(
                'Product not found'
            );
        }

        $countryCode = $this->countryResolver->resolveFromTaxNumber($taxNumber);

        $taxRate = $this->taxRateRepository
            ->findOneBy(['countryCode' => $countryCode->value]);

        if (!$taxRate) {
            throw new InternalException(
                sprintf('Tax rate not found for country %s', $countryCode->value)
            );
        }

        $coupon = null;
        if ($couponCode) {
            $coupon = $this->couponRepository->findOneBy(['code' => $couponCode]);
        }

        return $this->priceCalculator->calculateFinalPrice($product, $taxRate, $coupon);
    }
}