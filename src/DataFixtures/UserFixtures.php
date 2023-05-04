<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i = 0; $i <= 9; $i++ )
        {
            $user = new User();
            $user->setFirstname($faker->firstName());
            $user->setLastname($faker->lastName());
            $user->setEmail($faker->email());
            $user->setRoles(['ROLE_USER']);
            $user->setPlainPassword('password');
            // $user->setPassword($this->hasher->hashPassword($user, 'password'));
            // $hasherPassword = $this->hasher->hashPassword($user, 'password');
            //$user->setPassword($hasherPassword);

            $manager->persist($user);
        }
        $manager->flush();
    }
}
