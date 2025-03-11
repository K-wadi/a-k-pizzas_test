<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Pizza;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PizzaFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Categorieën ophalen uit de database
        $categories = $manager->getRepository(Category::class)->findAll();
        $categoryMap = [];
        foreach ($categories as $category) {
            $categoryMap[$category->getName()] = $category;
        }

        $pizzas = [
            // Vlees pizza's
            ['name' => 'BBQ Chicken', 'description' => 'Kip met BBQ saus', 'price' => 12.50, 'image' => 'bbq-chicken.jpg', 'category' => 'Vlees'],
            ['name' => 'Buffalo Chicken', 'description' => 'Pittige kip', 'price' => 13.00, 'image' => 'buffalo-chicken.jpg', 'category' => 'Vlees'],
            ['name' => 'Ham & Bacon', 'description' => 'Ham en spek', 'price' => 11.50, 'image' => 'ham-bacon.jpg', 'category' => 'Vlees'],
            ['name' => 'Hot Pepperoni', 'description' => 'Extra pittige pepperoni', 'price' => 11.50, 'image' => 'hot-pepperoni.jpg', 'category' => 'Vlees'],
            ['name' => 'Salami', 'description' => 'Italiaanse salami', 'price' => 11.00, 'image' => 'salami.jpg', 'category' => 'Vlees'],
            ['name' => 'Tandoori', 'description' => 'Tandoori kip met kruiden', 'price' => 13.50, 'image' => 'tandoori.jpg', 'category' => 'Vlees'],
            ['name' => 'Spicy Meat', 'description' => 'Mix van pittig vlees', 'price' => 14.00, 'image' => 'spicy-meat.jpg', 'category' => 'Vlees'],
            ['name' => 'Mexican Fire', 'description' => 'Pittige Mexicaanse pizza', 'price' => 12.50, 'image' => 'mexican-fire.jpg', 'category' => 'Vlees'],

            // Vegetarische pizza's
            ['name' => 'Margherita', 'description' => 'Tomaat en mozzarella', 'price' => 10.00, 'image' => 'margherita.jpg', 'category' => 'Vegetarisch'],
            ['name' => 'Four Cheese', 'description' => 'Vier soorten kaas', 'price' => 13.00, 'image' => 'four-cheese.jpg', 'category' => 'Vegetarisch'],
            ['name' => 'Pesto Veggie', 'description' => 'Pesto en groenten', 'price' => 12.00, 'image' => 'pesto-veggie.jpg', 'category' => 'Vegetarisch'],
            ['name' => 'Spinazie Ricotta', 'description' => 'Spinazie en ricotta', 'price' => 12.50, 'image' => 'spinazie-ricotta.jpg', 'category' => 'Vegetarisch'],
            ['name' => 'Truffle Pizza', 'description' => 'Truffel en kaas', 'price' => 15.50, 'image' => 'truffle-pizza.jpg', 'category' => 'Vegetarisch'],
            ['name' => 'Caprese', 'description' => 'Tomaat, basilicum en mozzarella', 'price' => 11.50, 'image' => 'caprese.jpg', 'category' => 'Vegetarisch'],
            ['name' => 'Black Garlic', 'description' => 'Zwarte knoflook en groenten', 'price' => 14.00, 'image' => 'black-garlic.jpg', 'category' => 'Vegetarisch'],
            ['name' => 'Flaming Veggie', 'description' => 'Pittige groenten', 'price' => 13.00, 'image' => 'flaming-veggie.jpg', 'category' => 'Vegetarisch'],

            // Vis pizza's
            ['name' => 'Seafood', 'description' => 'Zeevruchten', 'price' => 14.00, 'image' => 'seafood-pizza.jpg', 'category' => 'Vis'],
            ['name' => 'Smoked Salmon', 'description' => 'Gerookte zalm', 'price' => 15.00, 'image' => 'salami.jpg', 'category' => 'Vis'],
            ['name' => 'Tuna Special', 'description' => 'Tonijn met rode ui', 'price' => 13.50, 'image' => 'spicy.jpg', 'category' => 'Vis'],
            ['name' => 'Anchovy Deluxe', 'description' => 'Ansjovis en kappertjes', 'price' => 14.50, 'image' => 'special.jpg', 'category' => 'Vis'],
            ['name' => 'Garlic Shrimp', 'description' => 'Knoflook garnalen', 'price' => 16.00, 'image' => 'seafood-pizza.jpg', 'category' => 'Vis'],
            ['name' => 'Pesto Fish', 'description' => 'Pesto en vis', 'price' => 13.00, 'image' => 'pesto-veggie.jpg', 'category' => 'Vis'],
            ['name' => 'Spicy Prawn', 'description' => 'Pittige garnalen', 'price' => 14.00, 'image' => 'spicy.jpg', 'category' => 'Vis'],
            ['name' => 'Nutella Pizza', 'description' => 'Chocolade topping', 'price' => 10.00, 'image' => 'nutella.jpg', 'category' => 'Specials'],

            // Specials
            ['name' => 'Inferno', 'description' => 'Extra pittige pizza', 'price' => 15.00, 'image' => 'inferno.jpg', 'category' => 'Specials'],
            ['name' => 'Sambal Chicken', 'description' => 'Pittige kip met sambal', 'price' => 13.50, 'image' => 'sambal-chicken.jpg', 'category' => 'Specials'],
        ];

        foreach ($pizzas as $data) {
            $pizza = new Pizza();
            $pizza->setName($data['name']);
            $pizza->setDescription($data['description']);
            $pizza->setPrice($data['price']);
            $pizza->setImage($data['image']);
            $pizza->setCategory($categoryMap[$data['category']]);
            $manager->persist($pizza);
        }

        $manager->flush();
    }
}

