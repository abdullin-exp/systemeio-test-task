<?php

declare(strict_types=1);

namespace App\Enum;

enum CountryCode: string
{
    case GERMANY = 'DE';
    case ITALY   = 'IT';
    case FRANCE  = 'FR';
    case GREECE  = 'GR';
}