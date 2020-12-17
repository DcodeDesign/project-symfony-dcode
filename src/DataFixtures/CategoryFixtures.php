<?php

namespace App\DataFixtures;

use App\Entity\SecurityUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\User;

class CategoryFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {

    }
}
