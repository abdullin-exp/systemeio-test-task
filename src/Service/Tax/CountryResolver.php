<?php

declare(strict_types=1);

namespace App\Service\Tax;

use App\Enum\CountryCode;
use App\Exception\InternalException;

final class CountryResolver
{

    /**
     * @throws InternalException
     */
    public function resolveFromTaxNumber(
        string $taxNumber
    ): CountryCode
    {
        $code = substr($taxNumber, 0, 2);

        try {
            return CountryCode::from($code);
        } catch (\Throwable $exception) {
            throw new InternalException(
                sprintf('Unsupported country code in tax number: %s', $code),
            );
        }
    }
}