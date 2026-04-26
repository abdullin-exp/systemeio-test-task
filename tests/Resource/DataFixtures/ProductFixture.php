<?php

declare(strict_types=1);

namespace App\Tests\Resource\DataFixtures;

use App\Factory\ProductFactory;
use App\Tests\Resource\Tools\FakerTools;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixture extends Fixture
{

    use FakerTools;

    public const string REFERENCE_NAME = 'product';

    public function load(ObjectManager $manager): void
    {
        $product = ProductFactory::createOne([
            'name'  => $this->getFaker()->name(),
            'price' => $this->getFaker()->numberBetween(1000, 10000),
        ]);

        $manager->persist($product);
        $manager->flush();

        $this->addReference(self::REFERENCE_NAME, $product);
    }
}