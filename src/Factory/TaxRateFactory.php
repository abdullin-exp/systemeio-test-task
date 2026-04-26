<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\TaxRate;
use App\Enum\CountryCode;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

class TaxRateFactory extends PersistentObjectFactory
{

    protected function defaults(): array|callable
    {
        return [
            'countryCode'  => self::faker()->randomElement(CountryCode::cases()),
            'rate'         => self::faker()->numberBetween(19, 24),
        ];
    }

    public static function class(): string
    {
        return TaxRate::class;
    }
}