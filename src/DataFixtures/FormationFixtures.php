<?php

namespace App\DataFixtures;

use Faker\Factory;
use DateTimeImmutable;
use App\Entity\Formation;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FormationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
            $faker = Factory::create();

            for ($i = 1; $i <= 5; $i++)
            {
                $formation = new Formation();
                $formation->setName($faker->word());
                $formation->setSchool($faker->word());
                $formation->setGradeLevel($faker->numberBetween(2, 8));
                $formation->setDescription($faker->text());
                $formation->setStartedAt(new DateTimeImmutable("2020/03/03"));
                $formation->setEndedAt(new DateTimeImmutable("now"));
                $formation->setUser($this->getReference('user_'));

                $manager->persist($formation);
            }
                $manager->flush();
        }
        public function getDependencies()
        {
            return [
                UserFixtures::class,
            ];
        }
}
