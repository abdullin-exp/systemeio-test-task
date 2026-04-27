<?php

declare(strict_types=1);

namespace App\Tests\Resource\Story;

use App\Enum\CountryCode;
use App\Enum\CouponType;
use App\Factory\CouponFactory;
use App\Factory\ProductFactory;
use App\Factory\TaxRateFactory;
use Symfony\Component\Uid\UuidV7;
use Zenstruck\Foundry\Attribute\AsFixture;
use Zenstruck\Foundry\Story;

#[AsFixture(name: 'shop')]
final class ShopStory extends Story
{

    public function build(): void
    {
        ProductFactory::createSequence([
            ['id' => new UuidV7('019dce4e-f2fd-772c-8d07-dc7e967043c3'), 'name' => 'IPhone 17', 'price' => 90000],
            ['id' => new UuidV7('019dce4f-0f60-7975-a21d-c0fb2179cbf6'), 'name' => 'Air Pods 2', 'price' => 25000],
            ['id' => new UuidV7('019dce4f-271e-70f8-9d8e-6114025495cb'), 'name' => 'IPhone 17 Case', 'price' => 1000],
        ]);

        CouponFactory::createSequence([
            ['code' => 'PERCENT', 'type' => CouponType::PERCENT, 'discount' => 5],
            ['code' => 'ABSOLUTE', 'type' => CouponType::ABSOLUTE, 'discount' => 500],
        ]);

        TaxRateFactory::createSequence([
            ['countryCode' => CountryCode::GERMANY, 'rate' => 19],
            ['countryCode' => CountryCode::ITALY, 'rate' => 22],
            ['countryCode' => CountryCode::FRANCE, 'rate' => 20],
            ['countryCode' => CountryCode::GREECE, 'rate' => 24],
        ]);
    }
}
