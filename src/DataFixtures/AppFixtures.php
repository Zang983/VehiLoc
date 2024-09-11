<?php

namespace App\DataFixtures;

use App\Factory\CarFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $car = CarFactory::createMany(20);
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
