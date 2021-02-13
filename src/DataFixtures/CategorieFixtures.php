<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategorieFixtures extends Fixture
{
    public const CATEGORIE_REFERENCE = 'categorie';
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $categorie = new Categorie();
            $categorie->setNom($faker->sentence($nbWords = 2, $variableNbWords = true));
            $manager->persist($categorie);

        }
        $manager->flush();
        $this->addReference(self::CATEGORIE_REFERENCE, $categorie);
    }
}
