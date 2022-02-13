<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private $slugger;

    public function __construct(slugify $slugify){
        $this->slugger = $slugify;

    }
    public function load(ObjectManager $manager): void
    {
        
        $faker = \Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 5; $i++){

            $article = new Article();
            $article->setTitle($faker->sentence(3))
            ->setSlug($this->slugger->generate($article->getTitle()))
            ->setContent($faker->paragraph(1))
            ->setCover('https://picsum.photos/500/300')
            ->setCreatedAt($faker->datetime());

            $manager->persist($article);

        }

        $manager->flush();
    }
}
