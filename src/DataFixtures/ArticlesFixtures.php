<?php

namespace App\DataFixtures;

use App\Entity\Articles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticlesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $articles = new articles();
            $articles->setTitle('title '.$i);
            $articles->setContentArticle('Lorem ipsum dolor sit amet, consectetur adipiscing elit.');
            $articles->addCategory();
            $articles->setUserID();
            $manager->persist($articles);
        }

        $manager->flush();
    }


    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            UserFixtures::class
        ];
    }
}
