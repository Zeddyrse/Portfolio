<?php

namespace App\DataFixtures;

use Faker\Factory;
use DateTimeInterface;
use App\Entity\Experience;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ExperienceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 5; $i++)
        {
            $experience = new Experience();
            $experience->setTitle($faker->word());
            $experience->setCompagny($faker->company());
            $experience->setDescription($faker->text());
            $experience->setStartedAt(new DateTimeImmutable("2020/03/03"));
            $experience->setEndedAt(new DateTimeImmutable("now"));
            $experience->setUser($this->getReference('user_'));
            $this->addReference('experience_'. $i, $experience);

            $manager->persist($experience);
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
