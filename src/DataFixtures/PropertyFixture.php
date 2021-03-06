<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i=0; $i < 100; $i++) { 
            $property = new Property();
            $property
                ->setTitle($faker->words(3, true))
                ->setDescription($faker->sentences(3, true))
                ->setSurface($faker->numberBetween(20, 250))
                ->setRooms($faker->numberBetween(1, 10))
                ->setBedrooms($faker->numberBetween(1, 9))
                ->setFloor($faker->numberBetween(0, 15))
                ->setHeat($faker->numberBetween(0, count(Property::HEAT)-1))
                ->setCity($faker->city)
                ->setPrice($faker->numberBetween(40000, 1000000))
                ->setAddress($faker->address)
                ->setSold(false)
                ->setPostalCode($faker->postcode);
            $manager->persist($property);
        }
        $manager->flush();
    }
}
