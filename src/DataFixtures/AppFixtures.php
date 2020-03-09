<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use App\Entity\Ingredients;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Créer 20 catégories
        for ($i = 0; $i < 10; $i++) {
            $categories = new Categories();
            $categories->setNom('categorie '.$i);
            $manager->persist($categories);
        }

        // Créer 200 ingrédients
        for ($i = 0; $i < 10; $i++) {
            $ingredient = new Ingredients();
            $ingredient->setNom('categorie '.$i);
            $ingredient->setCategorie(mt_rand(1, 10));
            $manager->persist($ingredient);
        }
        
        $manager->flush();
    }
}
