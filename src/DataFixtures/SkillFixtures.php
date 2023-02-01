<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Skill;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SkillFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 5; $i++) {
            for ($j = 1; $j <= 5; $j++) {
                $skill = new Skill();
                $skill->setName($faker->word());
                $skill->setLevel($faker->numberBetween(1, 5));
                $skill->setExperience($this->getReference('experience_'.$j));
                $manager->persist($skill);
            }
        }
            $manager->flush();
    }
    public function getDependencies()
    {
        return [
            ExperienceFixtures::class,
        ];
    }
    
}
