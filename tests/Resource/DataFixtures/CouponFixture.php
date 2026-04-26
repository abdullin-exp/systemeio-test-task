<?php

declare(strict_types=1);

namespace App\Tests\Resource\DataFixtures;

use App\Enum\CouponType;
use App\Factory\CouponFactory;
use App\Tests\Resource\Tools\FakerTools;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CouponFixture extends Fixture
{

    use FakerTools;

    public const string REFERENCE_NAME = 'coupon';

    public function load(ObjectManager $manager): void
    {
        $coupon = CouponFactory::createOne([
            'code'     => $this->getFaker()->text(50),
            'type'     => $this->getFaker()->randomElement(CouponType::cases()),
            'discount' => $this->getFaker()->numberBetween(1, 99),
        ]);

        $manager->persist($coupon);
        $manager->flush();

        $this->addReference(self::REFERENCE_NAME, $coupon);
    }
}