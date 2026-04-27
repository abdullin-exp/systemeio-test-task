<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Coupon;
use App\Enum\CouponType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CouponFixture extends Fixture
{

    public const string REFERENCE_NAME = 'coupon';

    public function load(ObjectManager $manager): void
    {
        $absoluteCoupon = new Coupon();
        $absoluteCoupon->code = 'A50';
        $absoluteCoupon->type = CouponType::ABSOLUTE;
        $absoluteCoupon->discount = 50;

        $percentCoupon = new Coupon();
        $percentCoupon->code = 'P10';
        $percentCoupon->type = CouponType::PERCENT;
        $percentCoupon->discount = 10;

        $manager->persist($absoluteCoupon);
        $manager->persist($percentCoupon);

        $manager->flush();

        $this->addReference(self::REFERENCE_NAME . '_absolute', $absoluteCoupon);
        $this->addReference(self::REFERENCE_NAME . '_percent', $percentCoupon);
    }
}