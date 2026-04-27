<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\TaxRate;
use App\Enum\CountryCode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TaxRateFixture extends Fixture
{

    public const string REFERENCE_NAME = 'tax_rate';

    public function load(ObjectManager $manager): void
    {
        $taxRateGermany = new TaxRate();
        $taxRateGermany->countryCode = CountryCode::GERMANY;
        $taxRateGermany->rate = 19;

        $taxRateItaly = new TaxRate();
        $taxRateItaly->countryCode = CountryCode::ITALY;
        $taxRateItaly->rate = 22;

        $taxRateGreece = new TaxRate();
        $taxRateGreece->countryCode = CountryCode::GREECE;
        $taxRateGreece->rate = 20;

        $taxRateFrance = new TaxRate();
        $taxRateFrance->countryCode = CountryCode::FRANCE;
        $taxRateFrance->rate = 24;

        $manager->persist($taxRateGermany);
        $manager->persist($taxRateItaly);
        $manager->persist($taxRateGreece);
        $manager->persist($taxRateFrance);

        $manager->flush();

        $this->addReference(self::REFERENCE_NAME . '_de', $taxRateGermany);
        $this->addReference(self::REFERENCE_NAME . '_it', $taxRateItaly);
        $this->addReference(self::REFERENCE_NAME . '_gr', $taxRateGreece);
        $this->addReference(self::REFERENCE_NAME . '_fr', $taxRateFrance);
    }
}