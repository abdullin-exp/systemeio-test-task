<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\CountryCode;
use App\Repository\TaxRateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaxRateRepository::class)]
#[ORM\Table(name: 'tax_rates')]
class TaxRate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer')]
    public int $id;

    #[ORM\Column(name: 'country_code', length: 2, enumType: CountryCode::class)]
    public CountryCode $countryCode;

    #[ORM\Column(name: 'rate', type: 'integer')]
    private int $rate;
}
