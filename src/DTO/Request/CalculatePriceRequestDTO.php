<?php

declare(strict_types=1);

namespace App\DTO\Request;

use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as CustomAssert;

class CalculatePriceRequestDTO
{
    #[SerializedName('product')]
    #[Assert\NotBlank(message: 'product.identifier.not_blank')]
    #[Assert\Ulid(message: 'product.identifier.ulid')]
    #[CustomAssert\ProductExists]
    public string $product;

    #[SerializedName('taxNumber')]
    #[Assert\NotBlank(message: 'taxNumber.not_blank')]
    #[CustomAssert\TaxNumber]
    public string $taxNumber;

    #[SerializedName('couponCode')]
    #[Assert\Length(max: 50, maxMessage: 'couponCode.too_long')]
    #[CustomAssert\CouponExists]
    public ?string $couponCode = null;
}