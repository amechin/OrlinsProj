<?php

namespace App\DataFixtures;

use App\Entity\Annonce;
use App\Entity\User;
use App\Repository\UserRepository;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AnnonceFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 50; $i++) {
            $annonce = new Annonce();
            $annonce->setNom($faker->sentence($nbWords = 3, $variableNbWords = true));
            $annonce->setDescription($faker->sentence($nbWords = 8, $variableNbWords = true));
            $annonce->setPrix($faker->numberBetween($min = 1, $max = 100));
            $annonce->setAuteur($this->getReference(UserFixtures::ADMIN_USER_REFERENCE));
            $annonce->setCategorie($this->getReference(CategorieFixtures::CATEGORIE_REFERENCE));
            $manager->persist($annonce);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
