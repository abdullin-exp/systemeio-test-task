<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Product;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

final class ProductFactory extends PersistentObjectFactory
{

    protected function defaults(): array|callable
    {
        return [
            'name'  => self::faker()->name(),
            'price' => self::faker()->numberBetween(1000, 10000),
        ];
    }

    public static function class(): string
    {
        return Product::class;
    }
}