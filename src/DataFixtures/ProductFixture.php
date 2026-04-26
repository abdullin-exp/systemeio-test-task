<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Factory\ProductFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixture extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        ProductFactory::createMany(5);
    }
}