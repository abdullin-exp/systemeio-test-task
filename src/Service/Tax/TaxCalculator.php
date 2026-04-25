<?php

declare(strict_types=1);

namespace App\Service\Tax;

/**
 * Можно применить паттерн стратегию, если для каждой страны своя формула вычисления налога
 */
final class TaxCalculator
{

    public function calculate(
        int $price,
        int $rate
    ): int
    {
        return (int) round(
            $price * (1 + $rate / 100)
        );
    }
}