<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        $ingredients = [];
        for ($i = 1; $i <= 50; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setName($this->faker->word())
                       ->setPrice(mt_rand(1, 199));

            $manager->persist($ingredient);
            $ingredients[] = $ingredient;
        }

        for ($i = 1; $i <= 25; $i++) {
            $recipe = new Recipe();
            $recipe->setName($this->faker->word())
                   ->setTime(mt_rand(1, 1440))
                   ->setNbPersons(mt_rand(1, 50))
                   ->setDifficulty(mt_rand(1, 5))
                   ->setDescription($this->faker->paragraph())
                   ->setPrice(mt_rand(0, 1000))
                   ->setIsFavorite($this->faker->boolean());

            $randomIngredients = $this->faker->randomElements($ingredients, mt_rand(1, 5));
            foreach ($randomIngredients as $ingredient) {
                $recipe->addIngredient($ingredient);
            }

            $manager->persist($recipe);
        }

        $manager->flush();
    }
}