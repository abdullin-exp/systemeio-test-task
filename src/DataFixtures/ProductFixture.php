<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\UuidV7;

class ProductFixture extends Fixture
{

    public const string REFERENCE_NAME = 'product';

    public function load(ObjectManager $manager): void
    {
        $product1 = new Product();
        $product1->id = new UuidV7('019dce4e-f2fd-772c-8d07-dc7e967043c3');
        $product1->name = 'Air Pods';
        $product1->price = 10000;

        $product2 = new Product();
        $product2->id = new UuidV7('019dce4f-0f60-7975-a21d-c0fb2179cbf6');
        $product2->name = 'IPhone';
        $product2->price = 100000;

        $manager->persist($product1);
        $manager->persist($product2);

        $manager->flush();

        $this->addReference(self::REFERENCE_NAME . '_1', $product1);
        $this->addReference(self::REFERENCE_NAME . '_2', $product2);
    }
}