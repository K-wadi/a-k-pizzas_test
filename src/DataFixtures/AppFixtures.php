<?php
// Dit bestand vult de database met voorbeeldgegevens (testdata)

namespace App\DataFixtures;

// We importeren alle benodigde onderdelen
use App\Entity\Category;
use App\Entity\Pizza;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Deze class zorgt voor het vullen van de database met testgegevens
class AppFixtures extends Fixture
{
    // Deze functie wordt aangeroepen om de database te vullen
    public function load(ObjectManager $manager): void
    {
        // We maken eerst alle categorieën aan met hun pizza's
        $categories = [
            // Klassieke pizza's met hun gegevens
            'Klassieke Pizza\'s' => [
                ['name' => 'Margherita', 'description' => 'Tomatensaus, mozzarella, basilicum', 'price' => 8.50, 'image' => 'margherita.jpg'],
                ['name' => 'Pepperoni', 'description' => 'Tomatensaus, mozzarella, pepperoni', 'price' => 10.50, 'image' => 'pepperoni.jpg'],
                ['name' => 'Four Cheese', 'description' => 'Tomatensaus, mozzarella, gorgonzola, parmezaan, fontina', 'price' => 12.50, 'image' => 'four-cheese.jpg'],
                ['name' => 'Caprese', 'description' => 'Tomatensaus, mozzarella, verse tomaten, basilicum', 'price' => 11.50, 'image' => 'caprese.jpg'],
                ['name' => 'Funghi', 'description' => 'Tomatensaus, mozzarella, champignons', 'price' => 10.00, 'image' => 'funghi.jpg'],
                ['name' => 'Quattro Formaggi', 'description' => 'Tomatensaus, vier soorten kaas', 'price' => 12.50, 'image' => 'quattro-formaggi.jpg'],
                ['name' => 'Spicy Margherita', 'description' => 'Pittige tomatensaus, mozzarella, basilicum', 'price' => 9.50, 'image' => 'spicy-margherita.jpg'],
                ['name' => 'Burrata Special', 'description' => 'Tomatensaus, burrata, basilicum', 'price' => 13.50, 'image' => 'burrata.jpg'],
            ],
            // Speciale pizza's met hun gegevens
            'Speciale Pizza\'s' => [
                ['name' => 'BBQ Chicken', 'description' => 'BBQ saus, mozzarella, kip, rode ui, koriander', 'price' => 13.50, 'image' => 'bbq-chicken.jpg'],
                ['name' => 'Buffalo Chicken', 'description' => 'Pittige kip, mozzarella, rode ui, ranch saus', 'price' => 13.00, 'image' => 'buffalo-chicken.jpg'],
                ['name' => 'Tandoori', 'description' => 'Tandoori kip met kruiden, ui, paprika', 'price' => 13.50, 'image' => 'tandoori.jpg'],
                ['name' => 'Truffle', 'description' => 'Truffelsaus, mozzarella, champignons, rucola', 'price' => 15.50, 'image' => 'truffle-pizza.jpg'],
                ['name' => 'Pesto Deluxe', 'description' => 'Pestosaus, mozzarella, cherrytomaten, pijnboompitten', 'price' => 14.00, 'image' => 'pesto-veggie.jpg'],
                ['name' => 'Mexican Fire', 'description' => 'Tomatensaus, mozzarella, jalapeños, maïs, paprika', 'price' => 13.00, 'image' => 'mexican-fire.jpg'],
                ['name' => 'Black Garlic', 'description' => 'Zwarte knoflooksaus, mozzarella, champignons', 'price' => 14.50, 'image' => 'black-garlic.jpg'],
                ['name' => 'Special', 'description' => 'Chef\'s special met vlees', 'price' => 14.50, 'image' => 'special.jpg'],
            ],
            // Vlees pizza's met hun gegevens
            'Pizza\'s met Vlees' => [
                ['name' => 'Hot Pepperoni', 'description' => 'Extra pittige pepperoni, mozzarella, jalapeños', 'price' => 11.50, 'image' => 'hot-pepperoni.jpg'],
                ['name' => 'Salami', 'description' => 'Italiaanse salami, mozzarella, oregano', 'price' => 11.00, 'image' => 'salami.jpg'],
                ['name' => 'Ham & Bacon', 'description' => 'Ham, spek, mozzarella, ui', 'price' => 11.50, 'image' => 'ham-bacon.jpg'],
                ['name' => 'Spicy Meat', 'description' => 'Pepperoni, ham, spek, gehakt, mozzarella', 'price' => 14.50, 'image' => 'spicy-meat.jpg'],
                ['name' => 'Deluxe Vlees', 'description' => 'Mix van verschillende vleessoorten', 'price' => 15.50, 'image' => 'deluxe-vlees.jpg'],
                ['name' => 'Chili Cheese', 'description' => 'Pittig gehakt, jalapeños, cheddar', 'price' => 13.50, 'image' => 'chili-cheese.jpg'],
                ['name' => 'Sambal Chicken', 'description' => 'Kip met sambal, ui, paprika', 'price' => 13.50, 'image' => 'sambal-chicken.jpg'],
                ['name' => 'Inferno', 'description' => 'Extra pittige vleespizza met jalapeños', 'price' => 14.50, 'image' => 'inferno.jpg'],
            ],
            // Vegetarische pizza's met hun gegevens
            'Vegetarische Pizza\'s' => [
                ['name' => 'Vegetariana', 'description' => 'Tomatensaus, mozzarella, diverse groenten', 'price' => 12.50, 'image' => 'vegetariana.jpg'],
                ['name' => 'Vegan Special', 'description' => 'Tomatensaus, vegan kaas, groenten', 'price' => 13.50, 'image' => 'vegan-special.jpg'],
                ['name' => 'Vegan', 'description' => 'Tomatensaus, vegan kaas, champignons', 'price' => 12.50, 'image' => 'vegan.jpg'],
                ['name' => 'Spinazie Ricotta', 'description' => 'Spinazie, ricotta, knoflook', 'price' => 13.00, 'image' => 'spinazie-ricotta.jpg'],
                ['name' => 'Mushroom Deluxe', 'description' => 'Mix van verschillende paddenstoelen', 'price' => 14.50, 'image' => 'mushroom-deluxe.jpg'],
                ['name' => 'Flaming Veggie', 'description' => 'Pittige groenten, jalapeños', 'price' => 13.00, 'image' => 'flaming-veggie.jpg'],
                ['name' => 'Prosciutto & Figs', 'description' => 'Vijgen, rucola, balsamico', 'price' => 15.50, 'image' => 'prosciutto-figs.jpg'],
                ['name' => 'Chili Cheese Veggie', 'description' => 'Pittige groenten, cheddar', 'price' => 13.50, 'image' => 'chili-cheese.jpg'],
            ],
        ];

        // Voor elke categorie maken we een nieuwe Category aan
        foreach ($categories as $categoryName => $pizzas) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);

            // Voor elke pizza in de categorie maken we een nieuwe Pizza aan
            foreach ($pizzas as $pizzaData) {
                $pizza = new Pizza();
                $pizza->setName($pizzaData['name']);
                $pizza->setDescription($pizzaData['description']);
                $pizza->setPrice($pizzaData['price']);
                $pizza->setImage($pizzaData['image']);
                $pizza->setCategory($category);
                $manager->persist($pizza);
            }
        }

        // We slaan alle gegevens op in de database
        $manager->flush();
    }
}
