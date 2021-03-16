<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++){
            $property = new Property();
            $property
            ->setTitle($faker->words(3, true))
            ->setDescription($faker->words(55, true))
            ->setSurface($faker->numberBetween(20, 300))
            ->setRooms($faker->numberBetween(3, 10))
            ->setBedrooms($faker->numberBetween(1, 3))
            ->setFloor($faker->numberBetween(3, 10))
            ->setPrice($faker->numberBetween(10000, 100000000))
            ->setHeat($faker->numberBetween(0, count(Property::HEAT) - 1))
            ->setCity($faker->city)
            ->setAdress($faker->address)
            ->setPostalCode($faker->postcode)
            ->setSold(false);
            $manager->persist($property);
        }

        $manager->flush();
    }
}
