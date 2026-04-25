<?php

declare(strict_types=1);

namespace App\Enum;

enum CountryCode: string
{
    case GERMANY = 'DE';
    case ITALY   = 'IT';
    case FRANCE  = 'FR';
    case GREECE  = 'GR';

    public function taxNumberPatterns(): string
    {
        return match ($this) {
            self::GERMANY => '/^DE\d{9}$/',
            self::ITALY   => '/^IT\d{11}$/',
            self::FRANCE  => '/^FR[A-Z]{2}\d{9}$/',
            self::GREECE  => '/^GR\d{9}$/',
        };
    }
}