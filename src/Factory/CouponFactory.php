<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Coupon;
use App\Enum\CouponType;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

class CouponFactory extends PersistentObjectFactory
{

    protected function defaults(): array|callable
    {
        return [
            'code'     => self::faker()->text(50),
            'type'     => self::faker()->randomElement(CouponType::cases()),
            'discount' => self::faker()->numberBetween(1, 99),
        ];
    }

    public static function class(): string
    {
        return Coupon::class;
    }
}