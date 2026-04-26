<?php

declare(strict_types=1);

namespace App\Tests\Resource\DataFixtures;

use App\Enum\CountryCode;
use App\Factory\TaxRateFactory;
use App\Tests\Resource\Tools\FakerTools;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TaxRateFixture extends Fixture
{

    use FakerTools;

    public const string REFERENCE_NAME = 'tax_rate';

    public function load(ObjectManager $manager): void
    {
        $taxRate = TaxRateFactory::createOne([
            'countryCode' => $this->getFaker()->randomElement(CountryCode::cases()),
            'rate'        => $this->getFaker()->numberBetween(19, 24),
        ]);

        $manager->persist($taxRate);
        $manager->flush();

        $this->addReference(self::REFERENCE_NAME, $taxRate);
    }
}