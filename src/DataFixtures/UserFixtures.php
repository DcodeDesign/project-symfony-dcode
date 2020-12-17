<?php

namespace App\DataFixtures;

use App\Entity\SecurityUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\User;

class UserFixtures extends Fixture
{
    private $_passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
         $this->_passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $user = new SecurityUser();
            $user->setEmail($i . "@email.com");
            $user->setPassword($this->_passwordEncoder->encodePassword($user, "demo" . $i));

            $manager->persist($user);
        }
        $manager->flush();
    }
}
