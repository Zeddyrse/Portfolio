<?php

namespace App\DataFixtures;

use Faker\Factory;
use DateTimeImmutable;
use App\Entity\Project;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProjectFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 5; $i++) {

                $projet = new Project();
                $projet->setName($faker->word());
                $projet->setTechnology($faker->word());
                $projet->setDescription($faker->numberBetween(1, 5));
                $projet->setImageName($faker->imageUrl(640, 480, 'animals', true));
                $projet->setLink($faker->url());
                $projet->setStartedAt(new DateTimeImmutable("2020/03/03"));
                $projet->setUpdatedAt(new DateTimeImmutable("2020/04/03"));
                $projet->setEndedAt(new DateTimeImmutable("now"));
                $manager->persist($projet);
        }

        $manager->flush();
    }
}
