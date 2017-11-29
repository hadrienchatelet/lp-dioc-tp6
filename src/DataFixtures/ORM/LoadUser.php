<?php

namespace App\DataFixtures\ORM;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUser extends Fixture
{
    const USER_PASSWORD = 'user';
    const USER_PASSWORD2 = 'toto';

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setFirstname('John');
        $user->setLastname('Doe');
        $user->setEmail('user@exemple.org');

        $password = $this->container->get('security.password_encoder')->encodePassword($user, self::USER_PASSWORD);
        $user->setPassword($password);

        $this->addReference('user', $user);

        $user2 = new User();

        $user2->setFirstname('Toto');
        $user2->setLastname('Titi');
        $user2->setEmail('toto@titi.tutu');
        $user2->setIsAuthor(true);

        $password = $this->container->get('security.password_encoder')->encodePassword($user2, self::USER_PASSWORD2);
        $user2->setPassword($password);

        $this->addReference('user2', $user2);

        $manager->persist($user);
        $manager->persist($user2);
        $manager->flush();
    }
}
