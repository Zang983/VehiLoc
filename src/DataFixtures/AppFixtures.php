<?php

namespace App\DataFixtures;

use App\Factory\CarFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use function Zenstruck\Foundry\faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $car = CarFactory::createMany(20, function () {
            $dailyPrice = faker()->randomFloat(2, 10, 60);
            return [
                'daily_price' => $dailyPrice,
                'monthly_price' => $dailyPrice * 30,
            ];
        });
    // $product = new Product();
    // $manager->persist($product);

$manager->flush();
}
}
